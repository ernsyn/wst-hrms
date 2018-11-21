<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'leave_types';


    protected $fillable = [
        'name',
        'code' ,
        'name' ,
        'increment_per_year',
        'apply_before_days',

       'approval_level',
       'carry_forward',
       'carry_forward_expiry_months',
       'divide_method',
       'allow_carry_forward',


    ];
}