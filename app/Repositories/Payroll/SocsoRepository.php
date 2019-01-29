<?php
namespace App\Repositories\Payroll;

interface SocsoRepository
{
    public function findByCategorySalary($category, $salary);
}

