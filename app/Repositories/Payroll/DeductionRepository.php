<?php
namespace App\Repositories\Payroll;

interface DeductionRepository
{
    public function findByFilter($filter);
}

