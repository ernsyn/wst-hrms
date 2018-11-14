<?php
namespace App\Repositories\Payroll;

class EloquentPayrollTrxAddition implements PayrollTrxAdditionRepository
{
    public function storeArray(array $data)
    {
        if(count($data)) PayrollTrxAdditionRepository::insert($data);
    }

}

