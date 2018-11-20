<?php
namespace App\Repositories\Payroll;

use App\PayrollTrx;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EloquentPayrollTrx implements PayrollTrxRepository
{
    public function create(array $data)
    {
        return PayrollTrx::create($data);
    }
    
    public function query(){
        return
        PayrollTrx::join('payroll_master as PM', 'PM.id', '=', 'payroll_trx.payroll_master_id')
        ->join('employees as EM', 'EM.id', '=', 'payroll_trx.employee_id')
        ->join('users as U', 'U.id', '=', 'EM.user_id')
//         ->join('countries as C', 'C.id', '=', 'U.country_id')
        ->join('employee_jobs as EJ', function($join){
            $join->on('EJ.emp_id', '=', 'EM.id');
//             ->on('EJ.default', '=', DB::raw('"1"'));
        })
        ->join('cost_centres as JM', 'JM.id', '=', 'EJ.id_JobMaster_main')
//         ->join('JobMaster as JM2', 'JM2.id', '=', 'EJ.id_JobMaster_category')
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
   /*      ->leftjoin('EmployeeBank as EB', function($join){
            $join->on('EB.id_EmployeeMaster', '=', 'EM.id')
            ->on('EB.status', '=', DB::raw('"Active"'));
        }) */
        ->select('payroll_trx.*', 'U.id as user_id', 
            //'C.citizenship', 
            'PM.company_id as company_id', 'PM.year_month', 'PM.period', 'PM.status', 'EM.id as employee_id', 'EM.code as employee_code', 'EM.full_name', 'EM.total_child', 'EM.pcb_group', 'JM.name as position', 'PayrollTrx.basic_salary as bs', 'PayrollTrx.seniority_pay as is', 'PayrollTrx.note as remark', 'EB.account_number',
            DB::raw('
                (SELECT start_date FROM employee_jobs WHERE id_EmployeeMaster = EM.id ORDER BY id ASC LIMIT 1) as joined_date,
                (PayrollTrx.basic_salary + PayrollTrx.seniority_pay) as cb,
                (PayrollTrx.basic_salary + PayrollTrx.seniority_pay) as contract_base,
                (SELECT SUM(amount) FROM payroll_trx_addition WHERE id_PayrollTrx = PayrollTrx.id) as total_addition,
                (SELECT SUM(amount) FROM payroll_trx_deduction WHERE id_PayrollTrx = PayrollTrx.id) as total_deduction,
                PayrollTrx.take_home_pay as thp,
                (SELECT JM2.seniority_pay FROM
                    employee_jobs AS EJ2 JOIN cost_centres as JM2 ON EJ2.id_JobMaster_category = JM2.id
                    WHERE EJ2.id_EmployeeMaster = EM.id AND JM2.status = "Active" AND EJ2.default = 1
                ) as seniority_pay_type,
                ROUND((PayrollTrx.kpi * PayrollTrx.bonus),2) as total_bonus,
                YEAR(CURDATE()) - YEAR(U.birthday) as age,
                CASE
                    WHEN JM2.payroll_type = "HQ with travel allowance" THEN 1
                    ELSE 0
                END as has_travel,
                MONTHNAME(STR_TO_DATE(PM.month, "%m")) as month_name
            ')
            );
    }

    public function all($paginate=false, $request_data){
        $isAdmin = (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Superadmin')? 1 : 0;
        $payroll_id = @$request_data['payroll_id'];
        $payroll_type = @$request_data['payroll_type'];
        $group_array = @$request_data['group_array'];
        $viewer_employee_id = @$request_data['viewer_employee_id'];
        $company_id = @$request_data['company_id'];
        
        $query = $this->query()
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
        ->leftjoin('EmployeeReportTo as ERT', 'ERT.id_EmployeeMaster', '=', 'EM.id')
        ->where(function($query) use($payroll_id){
            if($payroll_id) $query->where('PayrollTrx.payroll_master_id', $payroll_id);
        })
        ->where(function($query) use($payroll_type){
            if($payroll_type) $query->where('JM2.payroll_type', $payroll_type);
        })
        ->where(function($query) use($group_array, $isAdmin, $viewer_employee_id){
            if(($group_array || !$isAdmin)) {
                $query->whereIn('EM.id_GroupMaster', $group_array)
                ->orwhereIn('EM.id', $viewer_employee_id);
            }
            if($viewer_employee_id) $query->orwhereIn('ERT.report_id_EmployeeMaster', $viewer_employee_id);
        })
        ->where(function($query) use($company_id){
            if($company_id) $query->where('PM.id_CompanyMaster', $company_id);
        })
        ->groupby('PayrollTrx.id')
        ->orderby('PayrollTrx.id', 'ASC');
        
        return (@$paginate)? $query->paginate(10)->appends(Input::except('page')) : $query;
    }
    
    public function find($id) {
            
        return PayrollTrx::join('payroll_master as pm', 'pm.id', '=', 'payroll_trx.payroll_master_id')
            ->join('employees as e', 'e.id', '=', 'payroll_trx.employee_id')
            ->join('users as u', 'u.id', '=', 'e.user_id')
            ->join('employee_jobs as ej', 'ej.emp_id', '=', 'e.id') 
            ->join('employee_positions as ep', 'ep.id', '=', 'ej.emp_mainposition_id')
            ->select('payroll_trx.*', 'pm.company_id', 'pm.year_month', 'pm.period', 'pm.status', 'e.id as employee_id', 'e.code as employee_code', 'u.name','ep.name as position', 'payroll_trx.basic_salary as bs', 'payroll_trx.seniority_pay as is', 'payroll_trx.note as remark', DB::raw('
                (SELECT start_date FROM employee_jobs WHERE emp_id = e.id ORDER BY id ASC LIMIT 1) as joined_date,
                (payroll_trx.basic_salary + payroll_trx.seniority_pay) as cb,
                (payroll_trx.basic_salary + payroll_trx.seniority_pay) as contract_base,
                payroll_trx.take_home_pay as thp
            '))
            ->where('payroll_trx.id', $id)->get();
    }
    
    public function updateKPI($id, $request_data){
        
        $payroll_keys = ['id_PayrollMaster', 'id_EmployeeMaster', 'employee_epf', 'employee_eis', 'employee_socso', 'employee_pcb', 'employer_epf', 'employer_eis', 'employer_socso', 'seniority_pay', 'basic_salary', 'final_payment', 'note'];
        if($id != 'new') $payroll_keys = ['final_payment', 'note', 'kpi', 'bonus'];
        $store_data = [];
        foreach($payroll_keys as $key) {
            $store_data[$key] = @$request_data[$key];
        }
        
        if($id == 'new') {
            $store_data['created_by'] = Auth::user()->id;
            $store_data['updated_by'] = Auth::user()->id;
            return PayrollTrx::insertGetId($store_data);
        } else {
            $store_data['updated_by'] = Auth::user()->id;
            PayrollTrx::where('id', $id)->update($store_data);
        }
        
        return;
    }
    
}

