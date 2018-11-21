<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDependent extends Model
{
    protected $table = 'employee_dependents';

    protected $fillable = [
        'name',
        'relationship',
        'dob'
    ];
}