<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeExperience extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_experiences';
    protected $fillable = [
        'company',
        'position',
        'industry',
        'contact',
        'start_date',
        'end_date',
        'notes',
        'created_by',
        'emp_id'
    ];

    protected $dates = ['deleted_at'];
}
