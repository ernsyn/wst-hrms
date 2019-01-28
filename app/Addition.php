<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Addition extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'additions';
    protected $fillable = [
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
