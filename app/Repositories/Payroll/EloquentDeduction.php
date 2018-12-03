<?php
namespace App\Repositories\Payroll;

use App\Deduction;

class EloquentDeduction implements DeductionRepository
{
    public function findByFilter($filter)
    {
        $status = @$filter['status'];
        $cost_center_id = @$filter['idJobMasterCategory'];
        $grade_id = @$filter['idJobMasterGrade'];
        $companyId = $filter['companyId'];
        
        return
        Deduction::select('deductions.*')
        ->leftjoin('deduction_applies_to as DAT', 'DAT.deductions_id', '=', 'Deductions.id')
        ->where(function($query) use($companyId){
            $query->where('deductions.company_id', $companyId)
            ->orwhere('deductions.company_id', 0);
        })
        ->where(function($query) use($cost_center_id, $grade_id){
            if($cost_center_id && $grade_id) {
                $query->whereIn('DAT.job_master_id', [$cost_center_id, $grade_id])
                ->orwhere('deductions.company_id', 0);
            }
        })
        ->where(function($query) use($status){
            if($status) {
                if($status == 'Probationer') {
                    $query->where('deductions.confirmed_employee', 0);
                } else {
                    $query->where('deductions.confirmed_employee', 1);
                }
				$query->orwhere('deductions.company_id', 0);            }
        })
//         ->groupby('DeductionMaster.id')
        ->get();
    }

}

