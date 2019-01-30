<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Deduction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'deductions';
    protected $fillable =[
        'code' ,
        'name' ,
        'type' ,
        'amount' ,
        'statutory',
        'status',
        'company_id',
        'created_by',
        'ea_form_id',
        'confirmed_employee',
        'cost_centre',
        'employee_grade'
    ];
}
