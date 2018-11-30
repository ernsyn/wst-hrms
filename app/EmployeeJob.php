<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeJob extends Model
{
    protected $table = 'employee_jobs';

    protected $fillable = [
        'branch_id',
        'emp_mainposition_id',
        'department_id',
        'team_id',
        'cost_centre_id',
        'emp_grade_id',
        'start_date',
        'end_date',
        'basic_salary',
        'specification',
        'status',
        'created_by'
    ];

    public function main_position()
    {
        return $this->belongsTo('App\EmployeePosition', 'emp_mainposition_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Team', 'team_id');
    }

    public function cost_centre()
    {
        return $this->belongsTo('App\CostCentre', 'cost_centre_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\EmployeeGrade', 'emp_grade_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }
}
