<?php
namespace App\Repositories\Payroll;

interface PcbRepository
{
    public function findByFilter($filter);
}

