<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\LeaveAllocation;
use App\LeaveRequest;
use App\LeaveType;
use App\EmployeeJob;
use App\Employee;

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
            if(self::leaveTypeHasRule($leaveType, 'non_prorated')) {
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
            if(!self::leaveTypeHasRule($leaveAllocation->leave_type, 'non_prorated')) {
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

    public static function checkLeaveTypeValidity($emp_id, $leave_type_id, $start_date, $end_date) {
        $leaveType = LeaveType::with('applied_rules')->where('id', $leave_type_id)->first();
        
        foreach($leaveType->applied_rules as $rule) {
            switch ($rule->rule) {

            }
        }
    }

    public static function getLeaveTypesForEmployee(Employee $employee) {
        $leaveTypes = LeaveType::with('applied_rules')->get();
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
                        break  ;

                    case LeaveTypeRule::CONSECUTIVE:
                        // $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['consecutive'] = true;
                        break;
                    case LeaveTypeRule::REQUIRED_ATTACHMENT:
                        // $configuration = json_decode($rule->configuration);
                        $additionalLeaveTypeDetails['required_attachment'] = true;
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
                        if(strcasecmp($employee->gender, $configuration->gender) != 0) {
                            $includeLeaveType = false;
                        }
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

    // private static function leaveTypeGetRule($leaveType, $rule) {
    //     foreach($leaveType->applied_rules as $applied_rule) {
    //         Log::debug($applied_rule->rule." ".$rule);
    //         if($applied_rule->rule == $rule) {
    //             return $applied_rule;
    //         }
    //     }

    //     return null;
    // }

    private static function calculateEntitledDays($leaveType, $yearsOfService, $grade_id) {
        $entitledDays = 0;
        if(empty($leaveType->entitled_days)) {
            // Entitlement By Grade
            foreach($leaveType->lt_entitlements_grade_groups as $gradeGroup) {
                $gradeInGroup = false;
                foreach($gradeGroup->grades as $grade) {
                    // dd("Grade ".$grade_id." ".$grade->id);
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

}
