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
        'amount' ,
        'statutory',
        'status',
        'company_id',
        'ea_form_id',
        'confirmed_employee',
        'cost_centre',
        'employee_grade'
    ];
}
