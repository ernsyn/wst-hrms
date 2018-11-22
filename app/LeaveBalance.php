<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    protected $table = 'leave_balance';


    public function leave_types()
    {
        return $this->hasMany('App\LeaveType', 'id_leave_type');
    }
    
}