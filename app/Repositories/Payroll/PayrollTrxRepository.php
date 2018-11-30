<?php
namespace App\Repositories\Payroll;

interface PayrollTrxRepository
{
    public function create(array $data);
    
    public function find($id);
    
    public function findNext($id, $payroll_id);
    
    public function findByEmployee($payrollMasterId, $employeeId);
    
}

