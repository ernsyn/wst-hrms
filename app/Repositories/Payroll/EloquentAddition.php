<?php
namespace App\Repositories\Payroll;

use App\Addition;

class EloquentAddition implements AdditionRepository
{
    public function findByFilter($filter)
    {
        $isConfirmedEmployee = @$filter['isConfirmedEmployee'];
        $costCentreId = @$filter['costCentreId'];
        $jobGradeId = @$filter['jobGradeId'];
        $companyId = $filter['companyId'];
        
        return 
        Addition::select('additions.*')
        ->leftjoin('addition_cost_centre as acc', 'acc.addition_id', '=', 'additions.id')
        ->leftjoin('addition_employee_grade as aeg', 'aeg.addition_id', '=', 'additions.id')
        ->where(function($query) use($companyId){
            $query->where('additions.company_id', $companyId);
        })
        ->where(function($query) use($costCentreId, $jobGradeId){
            if($costCentreId) {
                $query->where('acc.cost_centre_id', $costCentreId);
            }
            
            if($jobGradeId) {
                $query->where('aeg.employee_grade_id', $jobGradeId);
            }
        })
        ->where(function($query) use($isConfirmedEmployee){
            if($isConfirmedEmployee) {
                if($isConfirmedEmployee) {
                    $query->where('additions.confirmed_employee', 1);
                } else {
                    $query->where('additions.confirmed_employee', 0);
                }
            }
        })
        ->where('additions.status', 'Active')
        ->get();
    }

}

