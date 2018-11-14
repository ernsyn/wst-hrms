<?php
namespace App\Repositories\Payroll;

use App\Addition;

class EloquentAddition implements AdditionRepository
{
    public function findByFilter($filter)
    {
        $status = @$filter['status'];
        $cost_center_id = @$filter['idJobMasterCategory'];
        $grade_id = @$filter['idJobMasterGrade'];
        $companyId = $filter['companyId'];
        return
        Addition::select('additions.*')
        ->leftjoin('addition_applies_to as AAT', 'AAT.addition_master_id', '=', 'additions.id')
        ->where(function($query) use($companyId){
            $query->where('Additions.company_id', $companyId)
            ->orwhere('Additions.company_id', 0);
        })
        ->where(function($query) use($cost_center_id, $grade_id){
            if($cost_center_id && $grade_id) {
                $query->whereIn('AAT.job_master_id', [$cost_center_id, $grade_id])
                ->orwhere('Additions.company_id', 0);
            }
        })
        ->where(function($query) use($status){
            if($status) {
                if($status == 'Probationer') {
                    $query->where('Additions.confirmed_employee', 0);
                } else {
                    $query->where('Additions.confirmed_employee', 1);
                }
                $query->orwhere('Additions.company_id', 0);
            }
        })
//         ->groupby('AdditionMaster.id')
        ->get();
    }

}

