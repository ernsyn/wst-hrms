<?php
namespace App\Repositories\Payroll;

interface EisRepository
{
    public function findByCategorySalary($category, $salary);
}

