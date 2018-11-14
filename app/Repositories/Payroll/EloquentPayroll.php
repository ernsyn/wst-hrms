<?php
namespace App\Repositories\Payroll;

use App\PayrollMaster;

class EloquentPayroll implements PayrollRepository
{
    protected $payrollMaster;
    
    public function __construct(PayrollMaster $payrollMaster)
    {
        $this->payrollMaster = $payrollMaster;
    }
    
    public function isPayrollExists(array $data)
    {
        return $this->payrollMaster->where([
            ['year_month', $data['year_month']],
            ['period', $data['period']]
        ])->exists();
    }
}

