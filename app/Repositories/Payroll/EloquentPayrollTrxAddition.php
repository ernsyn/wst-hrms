<?php
namespace App\Repositories\Payroll;

use App\PayrollTrxAddition;

class EloquentPayrollTrxAddition implements PayrollTrxAdditionRepository
{
    public function query()
    {
        return
        PayrollTrxAddition::join('additions as a', 'a.id', '=', 'payroll_trx_addition.additions_id')
        ->join('payroll_trx as pt', 'pt.id', '=', 'payroll_trx_addition.payroll_trx_id')
        ->join('payroll_master as pm', 'pm.id', '=', 'pt.payroll_master_id')
        ->join('employees as e', 'e.id', '=', 'pt.employee_id')
        ->join('users as u', 'u.id', '=', 'e.user_id')
        ->select('payroll_trx_addition.*', 'u.id as user_id', 'a.name', 'a.type', 'a.code', 'e.company_id', 'pm.status');
    }
    
    public function storeArray(array $data)
    {
        if(count($data)) {
            $currentUser = auth()->user()->id;
            foreach ($data as $d) {
                $payrollTrxAddition = new PayrollTrxAddition();
                $payrollTrxAddition->payroll_trx_id = $d['payroll_trx_id'];
                $payrollTrxAddition->additions_id = $d['additions_id'];
                $payrollTrxAddition->amount = $d['amount'];
                $payrollTrxAddition->created_by = $currentUser;
                $payrollTrxAddition->updated_by = $currentUser;
                $payrollTrxAddition->save();
            }
        }
    }
    
    public function findByPayrollTrxId($payrolltrx_id)
    {
        return $this->query()->where('payroll_trx_id', $payrolltrx_id)->get();
    }
    
    public function updateMulitpleData($request_data)
    {
        foreach($request_data as $key => $request) {
            if($request == null){
                $request = 0;
            }
            if(strpos($key, 'payrolltrxaddition_id_days_') === 0){
                $id = substr($key, 27);
                PayrollTrxAddition::where('id', $id)->update(['days'=>$request]);
                continue;
            } else if(strpos($key, 'payrolltrxaddition_id_hours_') === 0){
                $id = substr($key, 28);
                PayrollTrxAddition::where('id', $id)->update(['hours'=>$request]);
                continue;
            } else if(strpos($key, 'payrolltrxaddition_id_') === 0){
                $id = substr($key, 22);
                PayrollTrxAddition::where('id', $id)->update(['amount'=>$request]);
            }
        }
        
        return;
    }

}

