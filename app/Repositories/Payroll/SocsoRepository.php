<?php
namespace App\Repositories\Payroll;

interface SocsoRepository
{
    public function findBySalary($salary);
}

