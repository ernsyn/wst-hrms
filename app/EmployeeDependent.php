<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDependent extends Model
{
    use SoftDeletes;
    protected $table = 'employee_dependents';

    protected $fillable = [
        'name',
        'relationship',
        'dob'
    ];

    protected $dates = ['deleted_at'];
}
