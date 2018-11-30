<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class LeaveTypeRule
{
    const GENDER = 'gender';
    const CAN_CARRY_FORWARD = 'can_carry_forward';
    const MULTIPLE_APPROVAL_LEVELS_NEEDED = 'multiple_approval_levels_needed';
    const REQUIRED_ATTACHMENT =  'required_attachment';
    const MIN_APPLY_DAYS_BEFORE =  'min_apply_days_before';
    const CONSECUTIVE =  'consecutive';
    // const SHARED_WITH =  'shared_with';
    const MIN_EMPLOYMENT_PERIOD =  'min_employment_period';
    const MAX_NO_OF_CHILDREN =  'max_no_of_children';
    const UNPAID =  'unpaid';
    const INC_OFF_DAYS_BASED_ON_APPLIED_DAYS =  'inc_off_days_based_on_applied_days';
    const EMPLOYEE_CANNOT_APPLY =  'employee_cannot_apply';
    const INC_OFF_DAYS =  'inc_off_days';
    const MAX_AFTER_APPLIED_DAYS =  'max_after_applied_days';
    const DEDUCT_AFTER_LEAVE_TYPES_INSUFFICIENT =  'deduct_after_leave_types_insufficient';
    const MAX_APPLICATIONS =  'max_applications';
    const NO_LIMIT =  'no_limit';
    const MAX_DAYS_PER_APPLICATION =  'max_days_per_application';
    const NON_PRORATED = 'non_prorated';
    // const LEAVE_CALCULATION =  'leave_calculation';
}


