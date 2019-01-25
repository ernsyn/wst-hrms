<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Deduction extends Model
{
    protected $table = 'deductions';
    protected $fillable =[
        'code' ,
        'name' ,
        'type' ,
    //    'day' => 'required',
        'amount' ,
        'statutory',
        'status',
        'company_id',
        'created_by'

    ];
    public function cost_centres()
    {
        return $this->belongsToMany('App\CostCentre', 'deduction_cost_centre')
        ->withTimestamps();
    }

    public function employee_grades()
    {
        return $this->belongsToMany('App\EmployeeGrade')
        ->withTimestamps();
    }
    
}
