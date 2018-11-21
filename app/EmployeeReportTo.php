<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeReportTo extends Model
{
    protected $table = 'employee_report_to';

    protected $fillable = [
        'report_to_emp_id',
        'type',
        'kpi_proposer',
        'notes',
    ];

    public function report_to()
    {
        return $this->belongsTo('App\Employee', 'report_to_emp_id');
    }
}