<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeGrade extends Model
{
    use SoftDeletes;
    protected $table = 'employee_grades';

    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
