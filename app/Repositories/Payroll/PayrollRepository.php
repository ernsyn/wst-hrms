<?php
namespace App\Repositories\Payroll;

interface PayrollRepository 
{
    public function isPayrollExists(array $filter);
    
    public function getPayrollStartDate(array $data);
    
    public function findByPayrollMonthPeriod(array $data);
    
    public function findByPayrollMonth(array $data);
}

