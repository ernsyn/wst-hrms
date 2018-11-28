<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\LeaveAllocation;
use App\LeaveRequest;
use App\LeaveType;
use App\EmployeeJob;

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
    
    private static function leaveTypeHasRule($leaveType, $rule) {
        foreach($leaveType->applied_rules as $applied_rule) {
            Log::debug($applied_rule->rule." ".$rule);
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

}
