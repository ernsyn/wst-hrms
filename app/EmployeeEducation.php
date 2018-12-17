<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEducation extends Model
{
    use SoftDeletes;
    protected $table = 'employee_educations';
    protected $fillable = [
        'institution',
        'start_year',
        'end_year',
        'level',
        'major',
        'gpa',
        'description',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
