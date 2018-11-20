<?php
namespace App\Repositories\Payroll;

interface PayrollTrxAdditionRepository
{
    public function storeArray(array $data);
    
    public function findByPayrollTrxId($payrollTrxId);
}

