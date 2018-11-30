<?php
namespace App\Repositories\Payroll;

interface PayrollRepository 
{
//     protected $payrollMaster;
    
//     public function __construct(PayrollMaster $payrollMaster)
//     {
//         $this->payrollMaster = $payrollMaster;
//     }
    
//     public function isPayrollExists(array $data)
//     {
//         return $this->payrollMaster->where([
//             ['year_month', $data['year_month']],
//             ['period', $data['period']]
//         ])->exists();
//     }
	
    public function isPayrollExists(array $filter);
    
    public function getPayrollStartDate(array $data);
    
    public function findByPayrollMonthPeriod(array $data);
}

