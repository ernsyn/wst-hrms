<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeVisa extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_visas';
    protected $fillable = [
        'type',
        'visa_number',
        'passport_no',
        'expiry_date',
        'issued_by',
        'issued_date',
        'family_members',
        'created_by',
        'emp_id'
    ];
    protected $dates = ['deleted_at'];
}
