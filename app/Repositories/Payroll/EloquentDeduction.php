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
        Deduction::select('Deductions.*')
        ->leftjoin('deduction_applies_to as DAT', 'DAT.deduction_master_id', '=', 'Deductions.id')
        ->where(function($query) use($companyId){
            $query->where('Deductions.company_id', $companyId)
            ->orwhere('Deductions.company_id', 0);
        })
        ->where(function($query) use($cost_center_id, $grade_id){
            if($cost_center_id && $grade_id) {
                $query->whereIn('DAT.job_master_id', [$cost_center_id, $grade_id])
                ->orwhere('Deductions.company_id', 0);
            }
        })
        ->where(function($query) use($status){
            if($status) {
                if($status == 'Probationer') {
                    $query->where('Deductions.confirmed_employee', 0);
                } else {
                    $query->where('Deductions.confirmed_employee', 1);
                }
                $query->orwhere('Deductions.company_id', 0);
            }
        })
//         ->groupby('DeductionMaster.id')
        ->get();
    }

}

