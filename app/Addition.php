<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $table = 'additions';
    
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