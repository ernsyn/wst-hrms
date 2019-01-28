<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeReportTo extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_report_to';

    protected $fillable = [
        'report_to_emp_id',
        'emp_id',
        'type',
        'kpi_proposer',
        'notes',
        'report_to_level',
        'created_by',
    ];

    protected $dates = ['deleted_at'];


    public function report_to()
    {
        return $this->belongsTo('App\Employee', 'emp_id'); 
        // return $this->belongsTo('App\Employee', 'report_to_emp_id');
        // return $this->belongsTo('App\Employee', 'report_to_emp_id');
    }

    public function employee_report_to()
    {
        return $this->belongsTo('App\Employee', 'report_to_emp_id'); 
        // return $this->belongsTo('App\Employee', 'report_to_emp_id');
        // return $this->belongsTo('App\Employee', 'report_to_emp_id');
    }

}
