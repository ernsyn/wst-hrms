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
        PayrollTrx::join('PayrollMaster as PM', 'PM.id', '=', 'PayrollTrx.id_PayrollMaster')
        ->join('EmployeeMaster as EM', 'EM.id', '=', 'PayrollTrx.id_EmployeeMaster')
        ->join('users as U', 'U.id', '=', 'EM.id_users')
        ->join('countries as C', 'C.id', '=', 'U.country_id')
        ->join('EmployeeJob as EJ', function($join){
            $join->on('EJ.id_EmployeeMaster', '=', 'EM.id')
            ->on('EJ.default', '=', DB::raw('"1"'));
        })
        ->join('JobMaster as JM', 'JM.id', '=', 'EJ.id_JobMaster_main')
        ->join('JobMaster as JM2', 'JM2.id', '=', 'EJ.id_JobMaster_category')
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
        ->leftjoin('EmployeeBank as EB', function($join){
            $join->on('EB.id_EmployeeMaster', '=', 'EM.id')
            ->on('EB.status', '=', DB::raw('"Active"'));
        })
        ->select('PayrollTrx.*', 'U.id as user_id', 'C.citizenship', 'PM.id_CompanyMaster as company_id', 'PM.month', 'PM.year', 'PM.period', 'PM.status', 'EM.id as employee_id', 'EM.code as employee_code', 'EM.full_name', 'EM.total_child', 'EM.pcb_group', 'JM.name as position', 'PayrollTrx.basic_salary as bs', 'PayrollTrx.seniority_pay as is', 'PayrollTrx.note as remark', 'EB.account_number',
            DB::raw('
                (SELECT start_date FROM EmployeeJob WHERE id_EmployeeMaster = EM.id ORDER BY id ASC LIMIT 1) as joined_date,
                (PayrollTrx.basic_salary + PayrollTrx.seniority_pay) as cb,
                (PayrollTrx.basic_salary + PayrollTrx.seniority_pay) as contract_base,
                (SELECT SUM(amount) FROM PayrollTrxAddition WHERE id_PayrollTrx = PayrollTrx.id) as total_addition,
                (SELECT SUM(amount) FROM PayrollTrxDeduction WHERE id_PayrollTrx = PayrollTrx.id) as total_deduction,
                PayrollTrx.final_payment as thp,
                (SELECT JM2.seniority_pay FROM
                    EmployeeJob AS EJ2 JOIN JobMaster as JM2 ON EJ2.id_JobMaster_category = JM2.id
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
            if($payroll_id) $query->where('PayrollTrx.id_PayrollMaster', $payroll_id);
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
    
}

