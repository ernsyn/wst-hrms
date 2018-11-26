<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeExperience extends Model
{
    use SoftDeletes;
    protected $table = 'employee_experiences';
    protected $fillable = [
        'company',
        'position',
        'start_date',
        'end_date',
        'notes'
    ];

    protected $dates = ['deleted_at'];
}
