<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class Naming
{
    public static $leaveTypeRule = [
        'min_apply_days_before' => 'Minimum Apply Days Before',
        'multiple_approval_levels_required' => 'Multiple Approval Levels Required',
        'can_carry_forward' => 'Can Carry Forward',
        'gender' => 'Restrict to Gender',
    ];
}