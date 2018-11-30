<?php
namespace App\Repositories\Payroll;

use App\Eis;

class EloquentEis implements EisRepository
{
    public function findBySalary($salary)
    {
        $eis = Eis::select('*')->where('salary', '>=', $salary)->orderby('salary', 'ASC')->first();
        
        // If no result, meaning that the salary is higher than the setting of eis, so, get the highest salary from DB.
        if(!@$eis) $eis = Eis::select('*')->where('salary', '<', $salary)->orderby('salary', 'DESC')->first();
        
        return $eis;
    }
}

