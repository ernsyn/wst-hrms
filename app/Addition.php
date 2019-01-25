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
        'employee_grade'
    ];
}
