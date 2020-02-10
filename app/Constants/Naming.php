<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class Naming
{
    private static $leaveTypeRule = [
        LeaveTypeRule::GENDER => 'Restrict: By Gender',
        LeaveTypeRule::CAN_CARRY_FORWARD => 'Can Carry Forward',
//         LeaveTypeRule::MULTIPLE_APPROVAL_LEVELS_NEEDED => 'Multiple Approval Levels Needed',
        LeaveTypeRule::REQUIRED_ATTACHMENT => 'Required: Attachment',
        LeaveTypeRule::MIN_APPLY_DAYS_BEFORE => 'Minimum Apply Days Before',
//         LeaveTypeRule::CONSECUTIVE => 'Consecutive Application',
        LeaveTypeRule::MIN_EMPLOYMENT_PERIOD => 'Required: Minimum Employment Period',
        LeaveTypeRule::MAX_NO_OF_CHILDREN => 'Max Number of Children',
        LeaveTypeRule::UNPAID => 'Unpaid Leave',
        LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS => 'Include Off Days (Based on Minimum Applied Days)',
        LeaveTypeRule::EMPLOYEE_CANNOT_APPLY => 'Employee Cannot Apply',
        LeaveTypeRule::INC_OFF_DAYS => 'Include Off Days',
//         LeaveTypeRule::MAX_AFTER_APPLIED_DAYS => 'Only Allowed To Apply Maximum After Days',
        LeaveTypeRule::DEDUCT_AFTER_LEAVE_TYPES_INSUFFICIENT => 'Deduct Other Leave Types if Insufficient',
//         LeaveTypeRule::MAX_APPLICATIONS => 'Maximum Applications',
        LeaveTypeRule::NO_LIMIT => 'No Applied Days Limit',
        LeaveTypeRule::MAX_DAYS_PER_APPLICATION => 'Maximum Days Per Application',
        LeaveTypeRule::NON_PRORATED => 'Non-Prorated',
        LeaveTypeRule::ALLOW_BACKDATED => 'Allow back-dated',
        LeaveTypeRule::PROBATIONER_CANT_APPLY => 'Probationer cannot apply',
        LeaveTypeRule::NATIONALITY => 'Nationality',  //Malaysian - dropdown
        LeaveTypeRule::AVAILABLE_TO_APPLY_ON => 'Available to apply on', //Monday, Tuesday, Wednesday, Thursday, Friday
        LeaveTypeRule::VALID_WITHIN_MONTH => 'Valid within (n) month',   //Valid within (n) month
        LeaveTypeRule::INCLUDE_HR_VERIFY => 'Include HR verify',
        LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL => 'Include HR Final Approval',
    ];

    public static function leaveTypeRule($rule) {
        if(array_key_exists($rule, self::$leaveTypeRule)) {
            return self::$leaveTypeRule[$rule];
        } else {
            return $rule;
        }
    }
}