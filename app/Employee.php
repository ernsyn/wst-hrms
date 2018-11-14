<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    }
    
    public function employeeJob()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id', 'emp_id');
    }
}