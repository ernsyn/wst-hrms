<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeVisa extends Model
{
    use SoftDeletes;
    protected $table = 'employee_visas';
    protected $fillable = [
        'type',
        'visa_number',
        'passport_no',
        'expiry_date',
        'issued_by',
        'issued_date',
        'family_members',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
