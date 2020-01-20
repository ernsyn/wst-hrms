<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpReportToPP extends Model
{
    protected $table = 'emp_report_to_pp';
    public $timestamps = false;
    
    public function payroll_period()
    {
        return $this->belongsTo('App\PayrollPeriod', 'payroll_period_id');
    }
}