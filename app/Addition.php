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
        'amount' ,
        'statutory',
        'status',
        'company_id',
        'ea_form_id',
        'confirmed_employee',
        'cost_centre',
        'employee_grade',
        'created_by'

    ];

    public function cost_centres()
    {
        return $this->belongsToMany('App\CostCentre', 'addition_cost_centre')
        ->withTimestamps();
    }

    public function employee_grades()
    {
        return $this->belongsToMany('App\EmployeeGrade', 'addition_employee_grade')
        ->withTimestamps();
    }



}
