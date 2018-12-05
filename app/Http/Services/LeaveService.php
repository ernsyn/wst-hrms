<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use App\LeaveAllocation;
use App\LeaveRequest;
use App\LeaveType;
use App\LTAppliedRule;
use App\EmployeeJob;
use App\Employee;
use App\Holiday;
use App\Media;

use App\Constants\LeaveTypeRule;

class LeaveService
{
    public static function onJobStart($emp_id, $start_date, $grade_id) {
        $now = Carbon::now();
        $startDate = Carbon::parse($start_date);
        if($now->year != $startDate->year && $startDate->month == 12) {
            // Skip
            return;
        }

        // In order to calculate the leave allocations - we need to know how many years he has been working
        $yearsOfService = self::calculateEmployeeWorkingYears($emp_id);

        $leaveTypes = LeaveType::with('applied_rules', 'lt_conditional_entitlements', 'lt_entitlements_grade_groups.lt_conditional_entitlements', 'lt_entitlements_grade_groups.grades')->where('active', true)->get();
        foreach($leaveTypes as $leaveType) {
            $allocatedDaysInAYear = self::calculateEntitledDays($leaveType, $yearsOfService, $grade_id);
            
            // Add leave allocation for employee
            // - beginning of next month till end of year

            $validFromDate = $startDate->copy();
            $validFromDate->month++;
            $validFromDate->day = 1;
            $validUntilDate = $startDate->copy();
            $validUntilDate->month = 12;
            $validUntilDate->day = 31;

            $allocatedDays = 0;
            if(self::leaveTypeHasRule($leaveType, LeaveTypeRule::NON_PRORATED)) {
                $allocatedDays = $allocatedDaysInAYear;
            } else {
                $allocatedDays = $allocatedDaysInAYear * (12-$validFromDate->month+1) / 12;
                $allocatedDays = floor($allocatedDays * 2)/2; // Round to closest .5 low
            }

            // dd($validFromDate);
            $leaveAllocation = LeaveAllocation::create([
                'emp_id' => $emp_id,
                'leave_type_id' => $leaveType->id,
                'valid_from_date' => $validFromDate,
                'valid_until_date' => $validUntilDate,
                'allocated_days' => $allocatedDays,
            ]);
            
        }
    }

    public static function onJobEnd($emp_id, $end_date) {
        $now = Carbon::now();
        $endDate = Carbon::parse($end_date);
        if($now->year != $endDate->year && $endDate->month == 12) {
            // Skip
            return;
        }

        $endCalcDate = $endDate->copy();
        $endCalcDate->month++;
        $endCalcDate->day = 1;
        $endCalcDate->subDay();

        $leaveAllocations = LeaveAllocation::with('leave_type.applied_rules')->where('emp_id', $emp_id)
        ->where('valid_from_date', '<=', $endCalcDate)
        ->where('valid_until_date', '>=', $endCalcDate)
        ->get();

        foreach($leaveAllocations as $leaveAllocation) {
            if(!self::leaveTypeHasRule($leaveAllocation->leave_type, LeaveTypeRule::NON_PRORATED)) {
                $allocationValidFromDate = Carbon::parse($leaveAllocation->valid_from_date);
                $allocationValidUntilDate = Carbon::parse($leaveAllocation->valid_until_date);
                $totalAllocationMonths = $allocationValidUntilDate->month - $allocationValidFromDate->month + 1;
                $totalActualMonths = $allocationValidUntilDate->month - $endCalcDate->month + 1;

                $updatedAllocatedDays = $leaveAllocation->allocated_days * $totalActualMonths / $totalAllocationMonths;
                $updatedAllocatedDays = floor($updatedAllocatedDays * 2)/2; // Round to closest .5 low

                $leaveAllocation->update([
                    'allocated_days' => $updatedAllocatedDays,
                    'valid_until_date' => $endCalcDate,
                ]);
            }
        }
    }

    public static function createLeaveRequest(Employee $employee, $leave_type_id, $start_date, $end_date, $am_pm, $reason, $attachment_data_url) {
        $result = self::checkLeaveRequest($employee, $leave_type_id, $start_date, $end_date, $am_pm);
        if(array_key_exists('error', $result)) {
            return $result;
        }

        if(array_key_exists('end_date', $result)) {
            $end_date = $result['end_date'];
        }

        $totalDays = $result['total_days'];

        $attachment_required = false;
        if(LTAppliedRule::where('leave_type_id', $leave_type_id)->where('rule', LeaveTypeRule::REQUIRED_ATTACHMENT)->count() > 0) {
            $attachment_required = true;
            if(empty($attachment_data_url)) {
                return self::error("Attachment required for this leave type.");
            }
        }

        $now = Carbon::now();
        $leaveAllocation = LeaveAllocation::where('emp_id', $employee->id)
        ->where('leave_type_id', $leave_type_id)
        ->where('valid_from_date', '<=', $now)
        ->where('valid_until_date', '>=', $now)
        ->first();

        $leaveRequest = null;
        DB::transaction(function () use ($employee, $leave_type_id, $leaveAllocation, $start_date, $end_date, $totalDays, $am_pm, $reason, $attachment_data_url, $attachment_required, &$leaveRequest) {
            $leaveRequest = LeaveRequest::create([
                'emp_id' => $employee->id,
                'leave_type_id' => $leave_type_id,
                'leave_allocation_id' => $leaveAllocation->id,
                'start_date' => $start_date,
                'end_date' => $end_date, 
                'am_pm' => $am_pm, 
                'applied_days' =>  $totalDays,
                'reason' => $reason,
                'status' => 'new'
            ]);

            $leaveAllocation->update([
                'spent_days' => $leaveAllocation->spent_days + $totalDays
            ]);
            
            if($attachment_required) {
                $attachmentData = self::processBase64DataUrl($attachment_data_url);
                $attachmentMedia = Media::create([
                    'category' => 'leave-request-attachment',
                    'mimetype' => $attachmentData['mime_type'],
                    'data' => $attachmentData['data'],
                    'size' => $attachmentData['size'],
                    'filename' => 'lr_attachmment_'.($employee->id).'_'.date('Y-m-d_H:i:s').".".$attachmentData['extension']
                ]);

                $leaveRequest->attachment()->associate($attachmentMedia);
                $leaveRequest->save();
            }
            
        });
        
        return $leaveRequest->id;
    }
    
    public static function getAllLeaveRequestsForEmployee($employee) {
        return LeaveRequest::with('leave_type')->where('emp_id', $employee->id)
        // ->where(function($q) use ($start_date, $end_date) {
        //     $q->where('start_date', '>=', $start_date);
        //     $q->where('start_date', '<=', $end_date);
        // })
        // ->OrWhere(function($q) use ($start_date, $end_date) {
        //     $q->where('end_date', '>=', $start_date);
        //     $q->where('end_date', '<=', $end_date);
        // })
        ->get();
    }

    public static function getLeaveRequestsForEmployee($employee, $start_date, $end_date) {
        return LeaveRequest::where('emp_id', $employee->id)
        ->where(function($q) use ($start_date, $end_date) {
            $q->where('start_date', '>=', $start_date);
            $q->where('start_date', '<=', $end_date);
        })
        ->OrWhere(function($q) use ($start_date, $end_date) {
            $q->where('end_date', '>=', $start_date);
            $q->where('end_date', '<=', $end_date);
        })
        ->get();
    }

    public static function checkLeaveRequest(Employee $employee, $leave_type_id, $start_date, $end_date, $am_pm) {
        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);
        $now = Carbon::now();
        
        if($startDate->greaterThan($endDate)) {
            return self::error("Start date is after end date.");
        }

        // Check if already has a leave on that day
        if(
            LeaveRequest::where('emp_id', $employee->id)
            ->where(function($q) use ($start_date, $end_date) {
                $q->where('start_date', '>=', $start_date);
                $q->where('start_date', '<=', $end_date);
            })
            ->OrWhere(function($q) use ($start_date, $end_date) {
                $q->where('end_date', '>=', $start_date);
                $q->where('end_date', '<=', $end_date);
            })
            ->where('status', '!=', 'rejected')
            ->count() > 0
        ) {
            return self::error("You already have a leave request for this day.");
        }
        
        $working_day = $employee->working_day;
        if(empty($working_day)) {
            return self::error("Employees working days not set yet.");
        }
        
        // Check if start/end day is non-working day or holiday
        if(!self::isWorkingDay($working_day, $startDate)) {
            return self::error("Start date cannot be a non-working day.");
        } else {
            $count = Holiday::where('start_date', '<=', $startDate)
            ->where('end_date', '>=', $startDate)
            ->where('status', 'active')->count();
            if($count > 0) {
                return self::error("Start date cannot fall on a holiday.");
            }
            
        }
        if(!self::isWorkingDay($working_day, $endDate)) {
            return self::error("End date cannot be a non-working day.");
        } else {
            $count = Holiday::where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $endDate)
            ->where('status', 'active')->count();
            if($count > 0) {
                return self::error("End date cannot fall on a holiday.");
            }
        }
        
        // Process applied rules for leave type
        $leaveType = LeaveType::with('applied_rules')->where('id', $leave_type_id)->first();
        
        $invalid = false;
        $invalidErrorMessage;
        // Related To: Leave Calculation
        $inc_off_days = false;
        $no_limit = false;
        $consecutive = false;
        
        $max_days_per_application;
        $min_apply_days_before_config;
        $inc_off_days_based_on_applied_days_config;
        
        foreach($leaveType->applied_rules as $rule) {
            switch ($rule->rule) {
                case LeaveTypeRule::GENDER:
                    $configuration = json_decode($rule->configuration);
                    if(strcasecmp($employee->gender, $configuration->gender) != 0) {
                        $invalid = true;
                        $invalidErrorMessage = "This leave does not apply to you.";
                    }
                    break;
                // case LeaveTypeRule::CAN_CARRY_FORWARD:
                // break;
                // case LeaveTypeRule::MULTIPLE_APPROVAL_LEVELS_NEEDED:
                // break;
                // case LeaveTypeRule::REQUIRED_ATTACHMENT:
                // break;
                case LeaveTypeRule::MIN_APPLY_DAYS_BEFORE:
                    $configuration = json_decode($rule->configuration);
                    // [{"min_leave_days": 2, "min_apply_days_before": 7}, {"min_leave_days": 5, "min_apply_days_before": 30}]
                    $days_before = date_diff($now, $startDate)->days;
                    $applied_days_length = date_diff($startDate, $endDate)->days;
                    foreach($configuration as $conditionEntry) {
                        if($applied_days_length >= $conditionEntry->min_leave_days) {
                            if($days_before < $conditionEntry->min_apply_days_before) {
                                $invalid = true;
                                $invalidErrorMessage = "To apply for leave equal or more than ".$conditionEntry->min_leave_days." days, you have to apply more than ".$conditionEntry->min_apply_days_before." days before."; 

                                break;
                            }
                        }
                    }
                    break;
                case LeaveTypeRule::CONSECUTIVE:
                    $consecutive = true;
                    break;
                case LeaveTypeRule::MIN_EMPLOYMENT_PERIOD:
                    $configuration = json_decode($rule->configuration);

                    $employedDays = self::calculateEmployeeWorkingDays($employee->id);
                    if($employedDays < $configuration->min_days) {
                        $invalid = true;
                        $invalidErrorMessage = "Minimum employment period for applying is ".$configuration->min_days." days.";
                    }
                    break;
                case LeaveTypeRule::MAX_NO_OF_CHILDREN:
                    $configuration = json_decode($rule->configuration);
                    if($employee->total_children >= $configuration->max_no_of_children) {
                        $invalid = true;
                        $invalidErrorMessage = "You have exceeded the maximum number of children for this leave.";
                    }
                    break;
                // case LeaveTypeRule::UNPAID:
                // break;
                case LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS:
                    $inc_off_days_based_on_applied_days_config = json_decode($rule->configuration);
                break;
                case LeaveTypeRule::EMPLOYEE_CANNOT_APPLY:
                    $invalid = true;
                    $invalidErrorMessage = "Employee cannot apply for this type of leave";
                break;
                case LeaveTypeRule::INC_OFF_DAYS:
                    $inc_off_days = true;
                    break;
                case LeaveTypeRule::MAX_AFTER_APPLIED_DAYS:
                    $configuration = json_decode($rule->configuration);

                    $days_after = date_diff($startDate, $now)->days;
                    if($days_after > $configuration->max_after_applied_days) {
                        $invalid = true;
                        $invalidErrorMessage = "Unable to apply for leave because it is more than ".$configuration->max_after_applied_days." after the date.";
                    }
                    break;
                // case LeaveTypeRule::DEDUCT_AFTER_LEAVE_TYPES_INSUFFICIENT:
                // break;
                case LeaveTypeRule::MAX_APPLICATIONS:
                    $configuration = json_decode($rule->configuration);
                    $count = LeaveRequests::where('emp_id', $employee->id)
                        ->where('leave_type_id', $leave_type_id)
                        ->where('status', '!=', 'rejected')
                        ->count();
                    if($count >= $configuration->max_applications) {
                        $invalid = true;
                        $invalidErrorMessage = "You have exceeded the maximum number of requests for this leave.";
                    }
                    break;
                case LeaveTypeRule::NO_LIMIT:
                    $no_limit = true;
                    break;
                case LeaveTypeRule::MAX_DAYS_PER_APPLICATION:
                    $configuration = json_decode($rule->configuration);
                    $max_days_per_application = $configuration->max_days_per_application;
                    break;
            }

            if($invalid) {
                break;
            }
        }

        if($invalid) {
            return self::error($invalidErrorMessage);
        }

        $additionalResponseData = array();
        if($consecutive) {

            $leaveAllocation = LeaveAllocation::where('emp_id', $employee->id)
            ->where('leave_type_id', $leave_type_id)
            ->where('valid_from_date', '<=', $now)
            ->where('valid_until_date', '>=', $now)
            ->first();

            if(!empty($leaveAllocation)) {
                $calcEndDate = $startDate->copy()->addDays($leaveAllocation->allocated_days-1);
                if(!$calcEndDate->equalTo($endDate)) {
                    $additionalResponseData['end_date'] = $calcEndDate->toDateString();
                    $endDate = $calcEndDate;
                }   
            }
        }

        // Calculate Leave
        $totalDays = date_diff($startDate, $endDate)->days + 1;

        
        if(!empty($inc_off_days_based_on_applied_days_config)) {
            $inc_off_days_min_apply_days = $inc_off_days_based_on_applied_days_config->min_apply_days;
            if($totalDays >= $inc_off_days_min_apply_days) {
                $inc_off_days = true;
            }
        }
        
        

        if(!$inc_off_days) {
            $nextDayIsHoliday = false;  
            if($startDate->dayOfWeek == Carbon::MONDAY) {
                $prevDate = $startDate->copy()->subDay(1);
                if(!self::isWorkingDay($working_day, $prevDate) && Holiday::where('end_date', $prevDate)->count() > 0) {
                    $nextDayIsHoliday = true;
                }
            }

            $holidays = Holiday::where('start_date', '>=', $startDate)
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->where('end_date', '<=', $endDate)
            ->where('status', 'active')->get();

            $cursorDate = $startDate->copy();
           while($cursorDate->lessThanOrEqualTo($endDate)) {
                if(!self::isWorkingDay($working_day, $cursorDate)) {
                    $nextDayIsHoliday = false;
                    if($cursorDate->dayOfWeek == Carbon::SUNDAY && self::isHoliday($holidays, $cursorDate)) {
                        $nextDayIsHoliday = true;
                    }

                    $totalDays--;
                } else if(self::isHoliday($holidays, $cursorDate) || $nextDayIsHoliday) {
                    $nextDayIsHoliday = false;
                    $totalDays--;
                }

                $cursorDate->addDays(1);
           } 
        }
                
       

       // NEXT STAGE: Check leave days available
       if($startDate->isSameDay($endDate) && $totalDays == 1) {
            if(!empty($am_pm)) {
                $totalDays -= 0.5;
            }
        }

        if(!empty($max_days_per_application)) {
            if($totalDays > $max_days_per_application) {
                return self::error("Max days (".$max_days_per_application." days) per application exceeded (".$totalDays." leave days applied).");
            }
        }

        $availableDays = self::getLeaveAllocationsAvailableDays($employee->id, $leave_type_id, $now);
        if($availableDays < $totalDays) {
            return self::error("Insufficient days (".$availableDays." days) for application (".$totalDays." leave days applied).");
        }

        return array_merge(
            [
                'total_days' => $totalDays,
            ], 
            $additionalResponseData
        );
    }

    public static function getLeaveTypesForEmployee(Employee $employee) {
        $leaveTypes = LeaveType::with('applied_rules')->where('active', true)->get();
        $employee->gender;

        Carbon::THURSDAY;
        
        $leaveTypesForUser = array();
        foreach($leaveTypes as $leaveType) {
            $additionalLeaveTypeDetails = array();
            $includeLeaveType = true;
            foreach($leaveType->applied_rules as $rule) {
                switch($rule->rule) {
                    case LeaveTypeRule::GENDER:
                        $configuration = json_decode($rule->configuration);
                        if(strcasecmp($employee->gender, $configuration->gender) != 0) {
                            $includeLeaveType = false;
                        }
                        break;

                    case LeaveTypeRule::CONSECUTIVE:
                        // $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['consecutive'] = true;
                        break;
                    case LeaveTypeRule::REQUIRED_ATTACHMENT:
                        $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['required_attachment'] = true;
                        $additionalLeaveTypeDetails['attachment_type'] = $configuration->attachment_type;

                        break;
                    case LeaveTypeRule::MAX_NO_OF_CHILDREN:
                        $configuration = json_decode($rule->configuration);
                        if($employee->total_children >= $configuration->max_no_of_children) {
                            $includeLeaveType = false;
                        }
                        break;
                    case LeaveTypeRule::EMPLOYEE_CANNOT_APPLY:
                        $includeLeaveType = false;
                        break;
                    case LeaveTypeRule::MAX_APPLICATIONS:
                        $configuration = json_decode($rule->configuration);
                        $count = LeaveRequests::where('emp_id', $employee->id)
                            ->where('leave_type_id', $leave_type_id)
                            ->where('status', '!=', 'rejected')
                            ->count();
                        if($count >= $configuration->max_applications) {
                            $includeLeaveType = false;
                        }
                        break;
                        break;
                    case LeaveTypeRule::MIN_EMPLOYMENT_PERIOD:
                        $configuration = json_decode($rule->configuration);

                        $employedDays = self::calculateEmployeeWorkingDays($employee->id);
                        if($employedDays < $configuration->min_days) {
                            $includeLeaveType = false;
                        }
                        break;
                    case LeaveTypeRule::NO_LIMIT:
                        // $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['no_limit'] = true;
                        break;
                    case LeaveTypeRule::MAX_DAYS_PER_APPLICATION:
                        $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['max_days_per_application'] = $configuration->max_days_per_application;
                        break;   
                }

                if(!$includeLeaveType) {
                    break;
                }
            }
            
            if($includeLeaveType) {
                array_push($leaveTypesForUser, array_merge(
                    [
                        'id' => $leaveType->id,
                        'name' => $leaveType->name,
                        'description' => $leaveType->description,
                        'available_days' => self::calculateLeaveTypeAvailableDaysForEmployee($employee->id, $leaveType->id)
                    ], 
                    $additionalLeaveTypeDetails)
                );
            }
        }
        
        return $leaveTypesForUser;
    }
    

    // PRIVATE FUNCTIONS
    private static function calculateLeaveTypeAvailableDaysForEmployee($emp_id, $leave_type_id) {
        $today = Carbon::now();
        $leaveAllocations = LeaveAllocation::where('emp_id', $emp_id)
            ->where('leave_type_id', $leave_type_id)
            ->where('valid_from_date', '<=', $today)
            ->where('valid_until_date', '>=', $today)
            // ->sum('allocated_days')
            // ->sum('spent_days')
            ->get();

        $totalAllocatedDays = 0;
        $totalSpentDays = 0;
        foreach($leaveAllocations as $leaveAllocation) {
            $totalAllocatedDays += $leaveAllocation->allocated_days;
            $totalSpentDays += $leaveAllocation->spent_days;
        }

        return $totalAllocatedDays - $totalSpentDays;
    }

    private static function leaveTypeHasRule($leaveType, $rule) {
        foreach($leaveType->applied_rules as $applied_rule) {
            if($applied_rule->rule == $rule) {
                return true;
            }
        }

        return false;
    }

    private static function calculateEntitledDays($leaveType, $yearsOfService, $grade_id) {
        $entitledDays = 0;
        if(empty($leaveType->entitled_days)) {
            // Entitlement By Grade
            foreach($leaveType->lt_entitlements_grade_groups as $gradeGroup) {
                $gradeInGroup = false;
                foreach($gradeGroup->grades as $grade) {
                    if($grade_id == $grade->id) {
                        $gradeInGroup = true;
                        break;
                    }
                }

                if($gradeInGroup) {
                    $entitledDays = $gradeGroup->entitled_days;
                    foreach($gradeGroup->lt_conditional_entitlements as $conditionalEntitlement) {
                        if($conditionalEntitlement->min_years > $yearsOfService) {
                            break;
                        } else {
                            $entitledDays = $conditionalEntitlement->entitled_days;
                        }
                    } 

                    break;
                }
            }
        } else {
            // Entitlement By Years
            $entitledDays = $leaveType->entitled_days;
            foreach($leaveType->lt_conditional_entitlements as $conditionalEntitlement) {
                if($conditionalEntitlement->min_years > $yearsOfService) {
                    break;
                } else {
                    $entitledDays = $conditionalEntitlement->entitled_days;
                }
            } 
        }

        return $entitledDays;
    }

    private static function calculateEmployeeWorkingYears($emp_id) {
        // Get start_date of first job
        $firstJob = EmployeeJob::where('emp_id', $emp_id)->orderBy('start_date')->first();
        if(empty($firstJob)) {
            return 0;
        } 

        $startDateTime = date_create($firstJob->start_date);
        $nowDateTime = date_create();
        
        return date_diff($startDateTime, $nowDateTime)->y;
    }

    private static function calculateEmployeeWorkingDays($emp_id) {
        // Get start_date of first job
        $firstJob = EmployeeJob::where('emp_id', $emp_id)->orderBy('start_date')->first();
        if(empty($firstJob)) {
            return 0;
        } 

        $startDateTime = date_create($firstJob->start_date);
        $nowDateTime = date_create();
        
        return date_diff($startDateTime, $nowDateTime)->days;
    }

    private static function error($message) {
        return [
            'error' => true,
            'message' => $message
        ];
    }

    private static function isWorkingDay($workingDays, $time) {
        switch($time->dayOfWeek) {
            case Carbon::MONDAY;
                return $workingDays->monday > 0;
                break;
            case Carbon::TUESDAY;
                return $workingDays->tuesday > 0;
                break;
            case Carbon::WEDNESDAY;
                return $workingDays->wednesday > 0;
                break;
            case Carbon::THURSDAY;
                return $workingDays->thursday > 0;
                break;
            case Carbon::FRIDAY;
                return $workingDays->friday > 0;
                break;
            case Carbon::SATURDAY;
                return $workingDays->saturday > 0;
                break;
            case Carbon::SUNDAY;
                return $workingDays->sunday > 0;
                break;
        }
    }

    private static function isHoliday($holidays, $date) {
        foreach ($holidays as $holiday) {
            $startDate = Carbon::parse($holiday->start_date);
            $endDate = Carbon::parse($holiday->end_date);

            if($date->greaterThanOrEqualTo($startDate) && $date->lessThanOrEqualTo($endDate)) {
                return true;
            }
        }

        return false;
    }

    private static function getLeaveAllocationsAvailableDays($emp_id, $leave_type_id, $now) {
        $leaveAllocations = LeaveAllocation::where('emp_id', $emp_id)
            ->where('leave_type_id', $leave_type_id)
            ->where('valid_from_date', '<=', $now)
            ->where('valid_until_date', '>=', $now)
            ->get();

        $totalAllocatedDays = 0;
        $totalSpentDays = 0;
        foreach($leaveAllocations as $leaveAllocation) {
            $totalAllocatedDays += $leaveAllocation->allocated_days;
            $totalSpentDays += $leaveAllocation->spent_days;
        }

        return $totalAllocatedDays - $totalSpentDays;
    }

    private static function processBase64DataUrl($dataUrl) {
        $parts = explode(',', $dataUrl);

        preg_match('#data:(.*?);base64#', $parts[0], $matches);
        $mimeType = $matches[1];
        $extension = explode('/', $mimeType)[1];

        $data = base64_decode($parts[1]);

        return [
            'data' => $data,
            'mime_type' => $mimeType,
            'size' => mb_strlen($data),
            'extension' => $extension
        ];
    }
}
