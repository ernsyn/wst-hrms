<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTrx extends Model
{
    protected $table = 'payroll_trx';
    protected $fillable = [
        'employee_info_id', 
        'payroll_master_id', 
        'employee_epf', 
        'employee_eis',
        'employee_socso',
        'employee_pcb',
        'employer_epf',
        'employer_eis',
        'employer_socso',
        'seniority_pay',
        'basic_salary',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
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
