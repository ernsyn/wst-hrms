<?php
namespace App\Repositories\Payroll;

interface PayrollTrxDeductionRepository
{
    public function storeArray(array $data);
    
    public function findByPayrollTrxId($payrollTrxId);
}

