<?php
namespace App\Repositories\Payroll;

use App\PayrollTrxDeduction;

class EloquentPayrollTrxDeduction implements PayrollTrxDeductionRepository
{
    public function storeArray(array $data)
    {
        if(count($data)) PayrollTrxDeduction::insert($data);
    }
    
    public function query(){
        return
        PayrollTrxDeduction::join('deductions as d', 'd.id', '=', 'payroll_trx_deduction.deductions_id')
        ->join('payroll_trx as pt', 'pt.id', '=', 'payroll_trx_deduction.payroll_trx_id')
        ->join('payroll_master as pm', 'pm.id', '=', 'pt.payroll_master_id')
        ->join('employees as e', 'e.id', '=', 'pt.employee_id')
        ->join('users as u', 'u.id', '=', 'e.user_id')
        ->select('payroll_trx_deduction.*', 'u.id as user_id', 'd.name', 'd.type', 'd.code', 'e.company_id', 'pm.status');
    }
    
    public function findByPayrollTrxId($payrolltrx_id){
        return $this->query()->where('payroll_trx_id', $payrolltrx_id)->get();
    }
    
    public function updateMulitpleData($request_data){
        foreach($request_data as $key => $request) {
            if($request == null){
                $request = 0;
            }
            if(strpos($key, 'payrolltrxdeduction_id_days_') === 0){
                $id = substr($key, 28);
                PayrollTrxDeduction::where('id', $id)->update(['days'=>$request]);
                continue;
            } else if(strpos($key, 'payrolltrxdeduction_id_') === 0){
                $id = substr($key, 23);
                PayrollTrxDeduction::where('id', $id)->update(['amount'=>$request]);
            }
        }
        
        return;
    }
}

