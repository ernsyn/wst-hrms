<?php
namespace App\Repositories\Payroll;

use App\PayrollTrxDeduction;

class EloquentPayrollTrxDeduction implements PayrollTrxDeductionRepository
{
    public function storeArray(array $data)
    {
        if(count($data)) PayrollTrxDeduction::insert($data);
    }

}

