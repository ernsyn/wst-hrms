<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSkill extends Model
{
    use SoftDeletes;
    protected $table = 'employee_skills';
    protected $fillable = [
        'name',
        'years_of_experience',
        'competency',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
