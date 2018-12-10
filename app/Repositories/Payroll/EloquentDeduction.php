<?php
namespace App\Repositories\Payroll;

use App\Deduction;

class EloquentDeduction implements DeductionRepository
{
    public function findByFilter($filter)
    {
        $isConfirmedEmployee = @$filter['isConfirmedEmployee'];
        $costCentreId = @$filter['costCentreId'];
        $jobGradeId = @$filter['jobGradeId'];
        $companyId = $filter['companyId'];
        
        return
        Deduction::select('deductions.*')
        ->leftjoin('deduction_cost_centre as dcc', 'dcc.deduction_id', '=', 'deductions.id')
        ->leftjoin('deduction_employee_grade as deg', 'deg.deduction_id', '=', 'deductions.id')
        ->where(function($query) use($companyId){
            $query->where('deductions.company_id', $companyId);
        })
        ->where(function($query) use($costCentreId, $jobGradeId){
            if($costCentreId) {
                $query->where('dcc.cost_centre_id', $costCentreId);
            }
            
            if($jobGradeId) {
                $query->where('deg.employee_grade_id', $jobGradeId);
            }
        })
        ->where(function($query) use($isConfirmedEmployee){
            if($isConfirmedEmployee) {
                if($isConfirmedEmployee) {
                    $query->where('deductions.confirmed_employee', 1);
                } else {
                    $query->where('deductions.confirmed_employee', 0);
                }
            }
        })
        ->where('deductions.status', 'Active')
        ->get();
    }

}

