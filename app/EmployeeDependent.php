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
        'relationship',
        'dob',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
