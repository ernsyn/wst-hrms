<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSecurityGroup extends Model
{
    protected $table = 'employee_security_groups';

    protected $fillable = [
        'emp_id',
        'security_group_id',
        'payroll_access',
     
    ];

    public function security_groups()
    {
        return $this->belongsTo('App\SecurityGroup','security_group_id');
    }
}