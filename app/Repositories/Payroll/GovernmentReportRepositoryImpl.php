<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 12/14/18
 * Time: 3:13 PM
 */

namespace App\Repositories\Payroll;

use App\Branch;
use App\CostCentre;
use App\Department;
use App\EmployeePosition;
use App\User;
use App\Company;
use Illuminate\Support\Facades\Auth;
use \DB;
use \Carbon;

class GovernmentReportRepositoryImpl implements GovernmentReportRepository
{

    /**
     * @return Company Information Object
     * Get company information based on current user logon
     */
    public function getUserLogonCompanyInformation(){
        $id = Auth::id();
        return User::find($id)->employee->company->where('status', 'Active')->first();
    }

    /**
     * @param $companyId
     * @return Company Information Object
     * Get company information based on given company id or current user logon
     */
    public function getCompanyInformation($companyId){
        if(empty($companyId)){
            $id = Auth::id();
            //echo $id;
            return User::find($id)->employee->company->where('status', 'Active')->first();
        }else{
            return Company::find($companyId)->where('status', 'Active')->first();
        }
    }

    /**
     * @return Cost Centre Information Object
     * Get list of Cost Centre information
     */
    public function getCostCentre(){
        return CostCentre::get();
    }

    /**
     * @return Department Information Object
     * Get list of Department information
     */
    public function getDepartments(){
        return Department::get();
    }

    /**
     * @return Branches Information Object
     * Get list of Branches
     */
    public function getBranches(){
        return Branch::get();
    }

    /**
     * @return Employee Position Information Object
     * Get list of Employee Position
     */
    public function getPosition(){
        return EmployeePosition::get();
    }


    /**
     * @param $companyId
     * @param $filter
     * @return Payroll information
     * Get LHDN Yearly Report payroll information based on given company id and filter
     */
    public function getLHDNYearlyReport($companyId,$filter){
        if(!empty($filter)) {
            return  DB::table('payroll_master')
                ->select(DB::raw('users.name,employees.tax_no,employees.ic_no,max(employees.total_children) as total_children'),
                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'))
                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees','payroll_trx.employee_id','employees.id')
                ->join('users','employees.user_id','users.id')
                ->where(array_keys($filter)[0],array_values($filter)[0])
                ->groupBy(DB::raw("payroll_trx.employee_id,users.name,employees.tax_no,employees.ic_no"))
                ->get();
        }else{
            return DB::table('payroll_master')
                ->select(DB::raw('users.name,employees.tax_no,employees.ic_no,max(employees.total_children) as total_children'),
                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'))
                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees','payroll_trx.employee_id','employees.id')
                ->join('users','employees.user_id','users.id')
                ->groupBy(DB::raw("payroll_trx.employee_id,users.name,employees.tax_no,employees.ic_no"))
                ->get();
        }
    }



}
