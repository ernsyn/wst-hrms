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
    
    public function getPayrollStartDate(array $data)
    {
        $payrollMonth = $data['year_month'];
        $period = $data['period'];
        
        $prevPayrollMonthTs = strtotime($payrollMonth.' -1 month');
        $prevPayrollMonth = date('Y-m-d', $prevPayrollMonthTs);
        
        $prevPayroll = $this->payrollMaster->where([
            ['year_month', $prevPayrollMonth],
            ['period', $period]
        ])->get();
        
        if (count($prevPayroll) > 0){
            $startDate = date('Y-m-d', strtotime($prevPayroll->end_date.' -1 days'));
        } else {
            $startDate = date('Y-m-d', strtotime('-1 months'));
        }
        
        return $startDate;
    }
    
    public function findByPayrollMonthPeriod(array $data)
    {
        return $this->payrollMaster->where([
            ['year_month', $data['year_month']],
            ['period', $data['period']],
            ['company_id', $data['companyId']]
        ])->get();
    }

}

