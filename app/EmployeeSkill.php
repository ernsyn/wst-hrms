<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeSkill extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_skills';
    protected $fillable = [
        'name',
        'years_of_experience',
        'competency',
        'created_by',
        'emp_id'
    ];

    protected $dates = ['deleted_at'];
}
