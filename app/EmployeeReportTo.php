<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeReportTo extends Model
{
    use SoftDeletes;
    protected $table = 'employee_report_to';

    protected $fillable = [
        'report_to_emp_id',
        'type',
        'kpi_proposer',
        'notes',
    ];

    protected $dates = ['deleted_at'];


    public function report_to()
    {
        return $this->belongsTo('App\Employee', 'user_id');
    }
}
