<?php
namespace App\Repositories\Payroll;

use App\Socso;

class EloquentSocso implements SocsoRepository
{
    public function findBySalary($salary)
    {
        $sosco = Socso::select('*')->where('salary', '>=', $salary)->orderby('salary', 'ASC')->first();
        
        // If no result, meaning that the salary is higher than the setting of eis, so, get the highest salary from DB.
        if(!@$sosco) $sosco = Socso::select('*')->where('salary', '<', $salary)->orderby('salary', 'DESC')->first();
        
        return $sosco;
    }

}

