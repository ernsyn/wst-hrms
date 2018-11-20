<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = 'deductions';
    
    public function cost_centres()
    {
        return $this->belongsToMany('App\CostCentre')
        ->withTimestamps();
    }

    public function employee_grades()
    {
        return $this->belongsToMany('App\EmployeeGrade')
        ->withTimestamps();
    }
}