<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeImmigration extends Model
{
    use SoftDeletes;
    protected $table = 'employee_immigrations';

    protected $fillable = [
        'passport_no',
        'expiry_date',
        'issued_by',
        'issued_date',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
