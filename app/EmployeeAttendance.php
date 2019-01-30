<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAttendance extends Model
{
    protected $table = 'employee_attendances';
    
    protected $fillable = [
        'emp_id',
        'date',
        'attendance',
    ];
    
    public function clock_in_out_records()
    {
        return $this->hasMany('App\EmployeeClockInOutRecord', 'emp_attendance_id');
    }
}
