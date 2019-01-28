<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeEducation extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
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
