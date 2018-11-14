<?php
namespace App\Repositories\Payroll;

interface EpfRepository
{
    public function findByFilter(array $filter);
    
}

