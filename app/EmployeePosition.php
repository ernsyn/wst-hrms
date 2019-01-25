<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeePosition extends Model
{
    use SoftDeletes;

    protected $table = 'employee_positions';

    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
