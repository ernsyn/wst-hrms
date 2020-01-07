<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PayrollTrx extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'payroll_trx';
    
    protected $fillable = [
        'employee_id', 
        'payroll_master_id', 
        'employee_epf', 
        'employee_eis',
        'employee_socso',
        'employee_pcb',
        'employer_epf',
        'employer_eis',
        'employer_socso',
        'basic_salary',
        'kpi',
        'bonus',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    
    public function payrollMaster()
    {
        return $this->belongsTo('App\PayrollMaster');
    }
    
    public function employeeInfo()
    {
        return $this->belongsTo('App\EmployeeInfo');
    }
    
    public function payrollTrxAddition()
    {
        return $this->hasMany('App\PayrollTrxAddition');
    }
    
    public function payrollTrxDeduction()
    {
        return $this->hasMany('App\PayrollTrxDeduction');
    }
}
