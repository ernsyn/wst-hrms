<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeDependent extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_dependents';

    protected $fillable = [
        'name',
        'ic_no',
        'occupation',
        'relationship',
        'dob',
        'created_by',
        'emp_id'
    ];

    protected $dates = ['deleted_at'];
}
