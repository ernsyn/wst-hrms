<?php
namespace App\Services;

use App\Repositories\Payroll\PayrollRepository;

class PayrollService
{
//     public function isPayrollExists(array $data)
//     {
//         return PayrollMaster::where([
//             ['year_month', $data['year_month'].'-01'],
//             ['period', $data['period']]
//         ])->exists();
//     }
    
    protected $payrollRepository;
    
    public function __construct(PayrollRepository $payrollRepository)
    {
        $this->payrollRepository = $payrollRepository;
    }
    
    public function isPayrollExists(array $data)
    {
        return $this->payrollRepository->isPayrollExists($data);
    }
}

