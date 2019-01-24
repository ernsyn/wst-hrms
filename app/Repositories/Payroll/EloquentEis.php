<?php
namespace App\Repositories\Payroll;

use App\Eis;

class EloquentEis implements EisRepository
{
    public function findByCategorySalary($category, $salary)
    {
        $eis = Eis::where([
            ['category', $category],
            ['salary', '>=', $salary]
        ])->orderby('salary', 'ASC')->first();
        
        // If no result, meaning that the salary is higher than the setting of eis, so, get the highest salary from DB.
        if(!@$eis) {
            $eis = Eis::where([
                ['category', $category],
                ['salary', '<', $salary]
            ])->orderby('salary', 'DESC')->first();
        }
        
        return $eis;
    }
}

