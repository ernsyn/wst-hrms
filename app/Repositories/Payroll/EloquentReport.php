<?php

namespace App\Repositories\Payroll;

use App\PayrollTrx;
use Illuminate\Support\Facades\DB;

class EloquentReport implements ReportRepository
{
    
    public function __construct()
    {
        
    }
    
    public function query()
    {
        return
        PayrollTrx::join('payroll_master as PM', 'PM.id', '=', 'payroll_trx.payroll_master_id')
        ->join('employees as EM', 'EM.id', '=', 'payroll_trx.employee_id')
        ->join('employee_jobs as EJ', function($join){
            $join->on('EJ.emp_id', '=', 'EM.id')
            ->on('EJ.basic_salary', '=', 'payroll_trx.basic_salary');
        })
        ->leftjoin('employee_bank_accounts as EB', function($join){
            $join->on('EB.emp_id', '=', 'EM.id')
            ->on('EB.acc_status', '=', DB::raw('"Active"'));
        })
        ->leftjoin('bank_code as BM', 'BM.name', '=', 'EB.bank_code')
        ->join('departments as JM_department', 'JM_department.id', '=', 'EJ.department_id')
        ->join('cost_centres as JM_category', 'JM_category.id', '=', 'EJ.cost_centre_id')
        ->join('companies as CM', 'CM.id', '=', 'EM.company_id')
        ->join('users', 'users.id','=','EM.user_id');
    }
    
    public function findByCompanyId($companyId, $requestData, $filterOption = null, $searchOption = null, $groupBy = null)
    {
//      dd($filterOption);
        $report = $requestData['report'];
        $year = $requestData['year'];
        $month = $requestData['month'];
//         $costCenter = @$filterOption['cost_centre_id'];
//         $department = @$filterOption['department_id'];
//         $branch = @$filterOption['branch_id'];
//         $position = @$filterOption['emp_mainposition_id'];
        $date = $year.'-'.$month.'-01';
        
        $query = $this->query()
        /** Unpaid Leave **/
        ->join('payroll_trx_deduction as PTD', 'PTD.payroll_trx_id', '=', 'payroll_trx.id')
        ->join('deductions as DM', function($join){
            $join->on('DM.id', '=', 'PTD.deductions_id')
            ->on('DM.code', '=', DB::raw('"UL"'));
        })
        /** OT (Overtime) **/
        ->join('payroll_trx_addition as PTA_OT', 'PTA_OT.payroll_trx_id', '=', 'payroll_trx.id')
        ->join('additions as AM_OT', function($join){
            $join->on('AM_OT.id', '=', 'PTA_OT.additions_id')
            ->on('AM_OT.code', '=', DB::raw('"OT"'));
        })
        ->where(function($query) use($companyId){
            if($companyId) {
                $query->where('CM.id', $companyId);
            }
        })
        ->where(function($query) use($date){
            $query->where('PM.year_month', $date);
        });
        /* ->where(function($query) use($costCenter){
            if($costCenter) {
                $query->where('EJ.cost_centre_id', $costCenter);
            }
        })
        ->where(function($query) use($department){
            if($department) { 
                $query->where('EJ.department_id', $department);
            }
        })
        ->where(function($query) use($branch){
            if($branch) {
                $query->where('EJ.branch_id', $branch);
            }
        })
        ->where(function($query) use($position){
            if($position) {
                $query->where('EJ.emp_mainposition_id', $position);
            }
        }) */
        
        //filter
        if(count($filterOption) > 0){
            foreach($filterOption as $key => $value){
                $query->where($key, $value);
            }
        }
        
        //search
        if(count($searchOption) > 0){
            foreach($searchOption as $key => $value){
                $query->whereIn($key, $value);
            }
        }
          
        if(count($groupBy) > 0){
            $query = $query->groupby($groupBy);
        }
        
        if($report == 1 || $report == 2) {
//             $query = $query->groupby($groupBy) // Department ID
            $query = $query->select('CM.name as company_name', 'CM.registration_no', 'JM_department.id as department_id', 'JM_department.name as department', 'JM_category.id as category', 'JM_category.name as cost_center', 'PM.period',
                DB::raw('
                    COUNT(EM.id) as total_employee,
                    SUM(payroll_trx.basic_salary) as total_basic_salary,
                    SUM(payroll_trx.seniority_pay) as total_seniority_pay,
                    SUM(PTD.amount) as total_unpaid_leave,
                    SUM(PTA_OT.amount) as total_overtime
                '),
                /** Sub Query - Total default addition **/
                DB::raw('
                    IFNULL((SELECT SUM(SUB_PTA.amount) FROM payroll_trx_addition AS SUB_PTA
                        JOIN additions AS SUB_AM
                            ON SUB_AM.id = SUB_PTA.additions_id AND SUB_AM.company_id = "0" AND SUB_AM.code != "OT"
                        JOIN payroll_trx AS SUB_PT
                            ON SUB_PT.id = SUB_PTA.payroll_trx_id
                        JOIN payroll_master AS SUB_PM
                            ON SUB_PM.id = SUB_PT.payroll_master_id
                        JOIN employees AS SUB_EM
                            ON SUB_EM.id = SUB_PT.employee_id
                        JOIN employee_jobs as SUB_EJ
                            ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                        JOIN departments as SUB_JM_DEPARTMENT
                            ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                        WHERE SUB_PM.year_month = "'.$date.'" AND SUB_JM_DEPARTMENT.id = JM_department.id
                    ),0.00) AS total_default_addition
                '),
                DB::raw('
                    0.00 as total_shift,
                    SUM(ROUND(payroll_trx.bonus*payroll_trx.kpi,2)) as total_bonus
                '),
                /** Sub Query - Total other addition **/
                DB::raw('
                    IFNULL((SELECT SUM(SUB_PTA.amount) FROM payroll_trx_addition AS SUB_PTA
                        JOIN additions AS SUB_AM
                            ON SUB_AM.id = SUB_PTA.additions_id AND SUB_AM.company_id != "0"
                        JOIN payroll_trx AS SUB_PT
                            ON SUB_PT.id = SUB_PTA.payroll_trx_id
                        JOIN payroll_master AS SUB_PM
                            ON SUB_PM.id = SUB_PT.payroll_master_id
                        JOIN employees AS SUB_EM
                            ON SUB_EM.id = SUB_PT.employee_id
                        JOIN employee_jobs as SUB_EJ
                            ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                        JOIN departments as SUB_JM_DEPARTMENT
                            ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                        WHERE SUB_PM.year_month = "'.$date.'" AND SUB_JM_DEPARTMENT.id = JM_department.id
                    ),0.00) AS total_other_addition
                '),
                DB::raw('
                    ROUND(SUM((payroll_trx.kpi*payroll_trx.bonus) + payroll_trx.basic_salary + payroll_trx.seniority_pay),2) as total_gross_pay,
                    SUM(payroll_trx.employee_epf) as total_employee_epf,
                    0.00 as total_employee_vol,
                    SUM(payroll_trx.employee_socso) as total_employee_socso,
                    SUM(payroll_trx.employee_eis) as total_employee_eis,
                    SUM(payroll_trx.employee_pcb) as total_employee_pcb
                '),
                /** Sub Query - Total other deduction **/
                DB::raw('
                    IFNULL((SELECT SUM(SUB_PTD.amount) FROM payroll_trx_deduction AS SUB_PTD
                        JOIN deductions AS SUB_DM
                            ON SUB_DM.id = SUB_PTD.deductions_id AND SUB_DM.company_id != "0"
                        JOIN payroll_trx AS SUB_PT
                            ON SUB_PT.id = SUB_PTD.payroll_trx_id
                        JOIN payroll_master AS SUB_PM
                            ON SUB_PM.id = SUB_PT.payroll_master_id
                        JOIN employees AS SUB_EM
                            ON SUB_EM.id = SUB_PT.employee_id
                        JOIN employee_jobs as SUB_EJ
                            ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                        JOIN departments as SUB_JM_DEPARTMENT
                            ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                        WHERE SUB_PM.year_month = "'.$date.'" AND SUB_JM_DEPARTMENT.id = JM_department.id
                    ),0.00) AS total_other_deduction
                '),
                DB::raw('
                    SUM(payroll_trx.take_home_pay) as total_net_pay,
                    SUM(payroll_trx.employer_epf) as total_employer_epf,
                    0.00 as total_employer_vol,
                    SUM(payroll_trx.employer_socso) as total_employer_socso,
                    SUM(payroll_trx.employer_eis) as total_employer_eis,
                    0.00 as total_employer_levy
                ')
            );

        } else if($report == 3 || $report == 4) {
//             $query = $query->groupby($groupby[0]); // Department or Category ID
//             if(count($groupby)>1) $query = $query->groupby($groupby[1]); // Department or Category ID
            $query = $query->select('JM_department.name as department', 'JM_category.name as cost_center',
                DB::raw('
                    SUM(payroll_trx.take_home_pay) as total_net_pay,
                    COUNT(EM.id) as total_employee,
                    ROUND(AVG(payroll_trx.take_home_pay),2) as average_net_pay
                ')
            );
        } else if($report == 5 || $report == 6) {
            $query = $query->whereNotNull('BM.id')
//                     ->groupby($groupby[0]) // Employee ID
//                     ->groupby($groupby[1]) // Bank ID
                ->orderby('EM.code', 'ASC')
                ->select('BM.name as bank', 'users.name', 'EM.code', 'EM.ic_no', 'EB.acc_no', 'payroll_trx.take_home_pay as net_pay');
        } else if($report == 7) {
//                     $query = $query->groupby($groupby[0]) // Company ID
            $query = $query->select('CM.name as company_name',
                DB::raw('
                    SUM(payroll_trx.take_home_pay) as total_net_pay,
                    ROUND(SUM((payroll_trx.kpi*payroll_trx.bonus) + payroll_trx.basic_salary + payroll_trx.seniority_pay),2) as total_gross_pay,
                    COUNT(EM.id) as total_employee
                ')
            );
        } else if($report == 8) {
//                     $query = $query->groupby($groupby[0]) // Department ID
//                     ->groupby($groupby[1]) // Employee ID
                    $query = $query->select(
                        'JM_department.name as department',
                        'EM.code',
                        'users.name',
                        'payroll_trx.basic_salary as total_basic_salary',
                        'payroll_trx.seniority_pay as total_seniority_pay',
                        'PTD.amount as total_unpaid_leave',
                        /** Sub Query - Total default addition **/
                        DB::raw('
                            IFNULL((SELECT SUM(SUB_PTA.amount) FROM payroll_trx_addition AS SUB_PTA
                                JOIN additions AS SUB_AM
                                    ON SUB_AM.id = SUB_PTA.additions_id AND SUB_AM.company_id = "0" AND SUB_AM.code != "OT"
                                JOIN payroll_trx AS SUB_PT
                                    ON SUB_PT.id = SUB_PTA.payroll_trx_id
                                JOIN payroll_master AS SUB_PM
                                    ON SUB_PM.id = SUB_PT.payroll_master_id
                                JOIN employees AS SUB_EM
                                    ON SUB_EM.id = SUB_PT.employee_id
                                JOIN employee_jobs as SUB_EJ
                                    ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                                JOIN payroll_trx as SUB_JM_DEPARTMENT
                                    ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                                WHERE SUB_PM.year_month = "'.$date.'" AND SUB_EM.id = EM.id
                            ),0.00) AS total_default_addition
                        '),
                        'PTA_OT.amount as total_overtime',
                        DB::raw('
                            0.00 as total_shift,
                            ROUND(payroll_trx.bonus*payroll_trx.kpi,2) as total_bonus,
                            IFNULL((SELECT SUM(SUB_PTA.amount) FROM payroll_trx_addition AS SUB_PTA
                                JOIN additions AS SUB_AM
                                    ON SUB_AM.id = SUB_PTA.additions_id AND SUB_AM.company_id != "0"
                                JOIN payroll_trx AS SUB_PT
                                    ON SUB_PT.id = SUB_PTA.payroll_trx_id
                                JOIN payroll_master AS SUB_PM
                                    ON SUB_PM.id = SUB_PT.payroll_master_id
                                JOIN employees AS SUB_EM
                                    ON SUB_EM.id = SUB_PT.employee_id
                                JOIN employee_jobs as SUB_EJ
                                    ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                                JOIN departments as SUB_JM_DEPARTMENT
                                    ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                                WHERE SUB_PM.year_month = "'.$date.'" AND SUB_EM.id = EM.id
                            ),0.00) AS total_other_addition,
                            ROUND((payroll_trx.kpi*payroll_trx.bonus) + payroll_trx.basic_salary + payroll_trx.seniority_pay,2) as total_gross_pay,
                            payroll_trx.employee_epf as total_employee_epf,
                            0.00 as total_employee_vol,
                            payroll_trx.employee_socso as total_employee_socso,
                            payroll_trx.employee_eis as total_employee_eis,
                            payroll_trx.employee_pcb as total_employee_pcb,
                            IFNULL((SELECT SUM(SUB_PTD.amount) FROM payroll_trx_deduction AS SUB_PTD
                                JOIN deductions AS SUB_DM
                                    ON SUB_DM.id = SUB_PTD.deductions_id AND SUB_DM.company_id != "0"
                                JOIN payroll_trx AS SUB_PT
                                    ON SUB_PT.id = SUB_PTD.payroll_trx_id
                                JOIN payroll_master AS SUB_PM
                                    ON SUB_PM.id = SUB_PT.payroll_master_id
                                JOIN employees AS SUB_EM
                                    ON SUB_EM.id = SUB_PT.employee_id
                                JOIN employee_jobs as SUB_EJ
                                    ON SUB_EJ.emp_id = SUB_EM.id AND SUB_EJ.basic_salary = SUB_PT.basic_salary
                                JOIN departments as SUB_JM_DEPARTMENT
                                    ON SUB_JM_DEPARTMENT.id = SUB_EJ.department_id
                                WHERE SUB_PM.year_month = "'.$date.'" AND SUB_EM.id = EM.id
                            ),0.00) AS total_other_deduction,
                            payroll_trx.take_home_pay as total_net_pay,
                            payroll_trx.employer_epf as total_employer_epf,
                            0.00 as total_employer_vol,
                            payroll_trx.employer_socso as total_employer_socso,
                            payroll_trx.employer_eis as total_employer_eis,
                            0.00 as total_employer_levy
                        ')
                    );
                }
                
                $list = $query->get();
                if($report == 1 || $report == 2) {
                    foreach($list as $key => $info){
                        $category_id = $info->category_id;
                        
                        $addition_list = $this->query()
                        ->join('payroll_trx_addition as PTA', 'PTA.payroll_trx_id', '=', 'payroll_trx.id')
                        ->join('additions as AM', function($join){
                            $join->on('AM.id', '=', 'PTA.additions_id')
                            ->on('AM.company_id', '<>', DB::raw('"0"'));
                        })
                        ->where('JM_department.id', $info->department_id)
                        ->where(function($query) use($report, $category_id){
                            if($report == '2') $query->where('JM_category.id', $category_id);
                        })
                        ->groupby('AM.id')
                        ->select('AM.code', 'AM.name',
                            DB::raw('
                                            SUM(PTA.amount) as amount
                                        ')
                            )
                            ->get();
                            $deduction_list = $this->query()
                            ->join('payroll_trx_deduction as PTD', 'PTD.payroll_trx_id', '=', 'payroll_trx.id')
                            ->join('deductions as DM', function($join){
                                $join->on('DM.id', '=', 'PTD.deductions_id')
                                ->on('DM.company_id', '<>', DB::raw('"0"'));
                            })
                            ->where('JM_department.id', $info->department_id)
                            ->where(function($query) use($report, $category_id){
                                if($report == '2') $query->where('JM_category.id', $category_id);
                            })
                            ->groupby('DM.id')
                            ->select('DM.code', 'DM.name',
                                DB::raw('
                                            SUM(PTD.amount) as amount
                                        ')
                                )
                                ->get();
                                
                                $info->additional_list = (object) array_merge((array) $addition_list, (array) $deduction_list);
                    }
                }
                
                return $list;
    }
    
}