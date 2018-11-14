<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function employee_jobs()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id');
    }
}