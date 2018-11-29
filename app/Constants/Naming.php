<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class Naming
{
    private static $leaveTypeRule = [
        'min_apply_days_before' => 'Minimum Apply Days Before',
        'multiple_approval_levels_required' => 'Multiple Approval Levels Required',
        'can_carry_forward' => 'Can Carry Forward',
        'gender' => 'Restrict: By Gender',
    ];

    public static function leaveTypeRule($rule) {
        if(array_key_exists($rule, self::$leaveTypeRule)) {
            return self::$leaveTypeRule[$rule];
        } else {
            return $rule;
        }
    }
}