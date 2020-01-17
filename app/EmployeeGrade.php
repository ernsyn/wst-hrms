<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeGrade extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_grades';

    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];

    public function grade()
    {
        return $this->hasMany('App\SalaryStructure', 'grade_id');
    }
}
