<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $table = 'additions';

    protected $fillable =[

        'code' ,
        'name' ,
        'type' ,
    //    'day' => 'required',
        'amount' ,
        'statutory',
        'status',
        'company_id'

    ];
    
    public function cost_centres()
    {
        return $this->belongsToMany('App\CostCentre', 'addition_cost_centre')
        ->withTimestamps();
    }

    public function employee_grades()
    {
        return $this->belongsToMany('App\EmployeeGrade')
        ->withTimestamps();
    }


  
}