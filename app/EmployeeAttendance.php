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
    
}
