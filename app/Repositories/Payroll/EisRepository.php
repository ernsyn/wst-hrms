<?php
namespace App\Repositories\Payroll;

interface EisRepository
{
    public function findBySalary($salary);
}

