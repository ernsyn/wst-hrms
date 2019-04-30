<?php
namespace App\Helpers;

use App\EmployeeAttendance;
use App\LeaveAllocation;
use App\PayrollSetup;
use App\EmployeeJob;
use App\Enums\EisCategoryEnum;
use App\EmployeeBankAccount;
use Illuminate\Support\Facades\Log;
use DB;

class PayrollHelper
{
    public static function calculateSalary($employee, $payroll)
    {
        /*
         * If worked for full month, use full basic salary.
         * If worked for less than a full moth (eg. Those joined the company on 5th of April)
         * - Basic salary / calendar days on that month * number of days worked in that month
         */
        Log::debug("Calculate Employee Salary");
        Log::debug($employee);
        Log::debug($payroll);
        $basicSalary = $employee->basic_salary;
        Log::debug("Employee ID: ".$employee->emp_id);
        Log::debug("Basic: ".$basicSalary);
        
        if($employee->end_date != null){
            Log::debug("Job end date not null");
            Log::debug("payroll period: ".$payroll->start_date.' '.$payroll->end_date);
            
            if($employee->start_date < $payroll->start_date){
                $dateDiff = date_diff(date_create($payroll->start_date), date_create($employee->end_date))->format('%R%a');
            }else{
                $dateDiff = date_diff(date_create($employee->start_date), date_create($employee->end_date))->format('%R%a');
            }
            Log::debug("date diff: ".$dateDiff);
            
            if($dateDiff >= 0) {
                $calendarDays = cal_days_in_month(CAL_GREGORIAN, substr($payroll->start_date,5,2), substr($payroll->start_date,0,4));
                Log::debug("calendarDays: ".$calendarDays);
                $basicSalary = $basicSalary / $calendarDays * ($dateDiff+1);
            }
        } else {
            Log::debug("Job end date null");
            Log::debug("Employee Start Date: ".$employee->start_date.', payroll end date: '.$payroll->end_date.', payroll start date: '.$payroll->start_date);
            // 1. full month - employee start <= payroll start date
            if($employee->start_date <= $payroll->start_date){
                Log::debug("Full month");
                $basicSalary = $basicSalary;
            } else {
                // 2. NEWLY JOINED
                $dateDiff = date_diff(date_create($employee->start_date), date_create($payroll->end_date))->format('%R%a');
                $payrollPeriodDiff = date_diff(date_create($payroll->start_date), date_create($payroll->end_date))->format('%R%a');
                Log::debug("date diff: ".$dateDiff);
                Log::debug("payrollPeriodDiff diff: ".$payrollPeriodDiff);
                
                if($dateDiff >= 0) {
                    $basicSalary = $basicSalary / ($payrollPeriodDiff+1) * ($dateDiff+1);
                }
            }
            
            
            /* $dateDiff = date_diff(date_create($payroll->start_date), date_create($payroll->end_date))->format('%R%a');
            Log::debug("date diff: ".$dateDiff);
            if($dateDiff >= 0) {
                
            }
            
            $firstDatePayrollEndDate = substr($payroll->end_date,0,8).'01';
            Log::debug("Employee Start Date: ".$employee->start_date.', payroll end date: '.$payroll->end_date.', payroll start date: '.$payroll->start_date.', $firstDatePayrollEndDate: '.$firstDatePayrollEndDate);
            if($firstDatePayrollEndDate <= $payroll->start_date) {
                Log::debug("firstDatePayrollEndDate <= payroll->start_date");
                $dateDiff = date_diff(date_create($firstDatePayrollEndDate), date_create($payroll->end_date))->format('%R%a');
                Log::debug("date diff: ".$dateDiff);
                
                if($dateDiff >= 0) {
                    $calendarDays = cal_days_in_month(CAL_GREGORIAN, substr($payroll->end_date,5,2), substr($payroll->end_date,0,4));
                    Log::debug("calendarDays: ".$calendarDays);
                    $basicSalary = $basicSalary / $calendarDays * ($dateDiff+1);
                }
            } else {
                Log::debug("firstDatePayrollEndDate > payroll->start_date");
                $dateDiff = date_diff(date_create($employee->start_date), date_create($payroll->end_date))->format('%R%a');
                Log::debug("date diff: ".$dateDiff);
                
                if($dateDiff >= 0) {
                    $calendarDays = cal_days_in_month(CAL_GREGORIAN, substr($payroll->end_date,5,2), substr($payroll->end_date,0,4));
                    Log::debug("calendarDays: ".$calendarDays);
                    $basicSalary = $basicSalary / $calendarDays * ($dateDiff+1);
                }
            } */
        }
        
        
//         $payrollStartDate = date_create($payrollMonth.'-01');//var_dump($payrollStartDate);
//         $employeeJoinedDate = date_create($employee->start_date);//var_dump($employeeJoinedDate);
//         $dateDiff = date_diff($payrollStartDate, $employeeJoinedDate)->format('%R%a');
        //var_dump($dateDiff);
//         if($dateDiff >= 0) {
//             $payrollMonth = explode('-', $payrollMonth);
//             $calendarDays = cal_days_in_month(CAL_GREGORIAN, $payrollMonth[1], $payrollMonth[0]);
//             $numOfDaysWorked = $calendarDays - $dateDiff;
//             $basicSalary = $basicSalary / $calendarDays * $numOfDaysWorked;
//         }
        
        
        Log::debug("Calculated Salary: ".$basicSalary);
        return $basicSalary;
    }
    
    public static function calculateSeniorityPay($employee, $payrollMonth, $costCentre)
    {
        Log::debug("Calculate Seniority Pay");
        Log::debug("Employee: ".$employee);
        Log::debug("Payroll Month: ".$payrollMonth);
        Log::debug("Cost Centre: ".$costCentre);
        // Start date of the month
        $beginDate = date_create($payrollMonth.'-01');
        $joinedDate = null;
        $seniorityPay = 0.00;
        if(isset($employee->employee_jobs()->first()->start_date)){
            $joinedDate = date_create($employee->employee_jobs()->first()->start_date);
            // Diff of the month/year and joined date
            $diff = date_diff($joinedDate, $beginDate);
            $diffYears = $diff->format('%R%y');
            //         var_dump($jobMaster);
            // If seniority pay is Auto,
            // then directly set 50 via .env
            // Else set to 0.00 and let admin to enter later
            
            //         dd($diffYears);
            Log::debug("Joined date");
//             Log::debug($joinedDate);
            Log::debug("diff year: ".$diffYears);
            
            if(strcasecmp($costCentre->first()->seniority_pay, 'auto') == 0 && $diffYears > 0) {
                $defaultSeniorityPay = PayrollSetup::where([
                    ['key', 'SENIORITY_PAY'],
                    ['company_id', $employee->company_id],
                    ['status', 1]
                ])->first();
                
                Log::debug("Default seniority pay: ".$defaultSeniorityPay);
                
                $seniorityPay = ($diffYears > 0)? $defaultSeniorityPay->value * $diffYears : $defaultSeniorityPay->value;
            }
        }
        Log::debug("Calculated seniority pay: ".$seniorityPay);
//         dd($seniorityPay);
        return $seniorityPay;
    }
    
    public static function getALPayback($employee, $payroll, $leaveBalance)
    {
        /*
         * If status is Resigned_date not null, check AL balance
         * 1. If basic salary < 1999 - use Basic salary / 26 * number of AL
         * 2. If basic salary >= 2000 - use Basic salary / calendar days on that month * number of AL
         */  
        $payback = 0.00;
        //         if($employee->resignation_date != null || $employee->resignation_date <= DateHelper::getLastDayOfDate($payrollMonth)) {
            $basicSalary = $employee->basic_salary;
//             $leaveBalance = self::getALBalance($employee, $payrollMonth);
            
            if($basicSalary >= 2000){
                $days = self::getNumberOfDayPayrollPeriod($payroll->start_date, $payroll->end_date);//DateHelper::getNumberDaysInMonth($payrollMonth);
                $payback = $basicSalary / $days * $leaveBalance;
            } else {
                $payback = $basicSalary / 26 * $leaveBalance;
            }
//         }
        
        return $payback;
    }
    
    public static function getAge($dateOfBirth)
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }
    
    // 20180921 Lin : This is the special case. For those addition need key in days,
    // only can calculate the amount of the addition.
    public static function payroll_addition_with_days()
    {
        return [
            // 'OT'        => 'Overtime',
            'ALP'       => 'Annual Leave Payback',
            'CFLP'      => 'Carry Forward Leave Payback',
            'PH'        => 'Public Holiday',
            'RD'        => 'Rest Day',
            'OD'        => 'Off Day'
        ];
    }
    
    // 20180924 Lin : This is the special cas. For those addition need key in hours,
    // only can calculate the amount of the addition.
    public static function payroll_addition_with_hours()
    {
        return [
            'OT'        => 'Overtime',
        ];
    }
    
    // 20180921 Lin : This is the special case. For those deduction need key in days,
    // only can calculate the amount of the deduction.
    public static function payroll_deduction_with_days()
    {
        return [
            'UL'        => 'Unpaid Leave',
        ];
    }
    
    //check if is confirmed employee for that payroll month
    public static function isConfirmedEmployee($employee, $payroll) 
    {
        if($employee->confirmed_date == null || $employee->confirmed_date > $payroll->end_date){
            return false;
        } else {
            return true;
        }
        
    }
    
    //check if resigned for that payroll month
    public static function isResigned($employee, $payroll) 
    {
        //         dd($employee->resignation_date);
        if($employee->resignation_date == null || $employee->resignation_date > $payroll->end_date){
            return false;
        } else {
            return true;
        }
        
    }
    
    //get AL balance for a payroll month
    public static function getALBalance($employee, $payrollMonth)
    {
        //not inused
        $payrollBackDatePeriod = PayrollHelper::getPayrollBackDatePeriod($employee);
        $processedStartDate = DateHelper::getPastNMonthDate($payroll->end_date, $payrollBackDatePeriod) ." 00:00:00";
        $payrollBackDatePeriod = PayrollHelper::getPayrollBackDatePeriod($employee);
        $processedStartDate = DateHelper::getPastNMonthDate($payroll->end_date, $payrollBackDatePeriod) ." 00:00:00";
        
        $leaveAllocations = LeaveAllocation::where([
            ['leave_type_id', 1],
            ['emp_id', $employee->id],
            ['valid_until_date', '>=', $processedStartDate],
            ['valid_until_date', '<=', DateHelper::getLastDayOfDate($payrollMonth)]
        ])->get();
        
        $totalAllocated = 0;
        $totalSpent = 0;
        foreach ($leaveAllocations as $leave) {
            $totalAllocated += $leave->allocated_days;
            $totalSpent += $leave->spent_days;
        }
        
        return $totalAllocated - $totalSpent;
    }
    
    // get attendance by clock in status
    public static function getAttendance($attendance, $employee, $processedStartDate, $processedEndDate)
    {
        $attendances = EmployeeAttendance::where([
            ['attendance', $attendance],
            ['emp_id', $employee->id],
            ['date', '>=', $processedStartDate],
            ['date', '<=', $processedEndDate],
        ])->get();
        
        return $attendances;
    }
    
    public static function getMinOtHour($employee)
    {
        $minOtHour = PayrollSetup::where([
            ['key', 'MIN_OT_HOUR'],
            ['company_id', $employee->company_id],
            ['status', 1]
        ])->first();
        
        return $minOtHour;
    }
    
    public static function getBasicSalaryByMonth($employee, $date)
    {
        $employeeJob = EmployeeJob::where([
            ['emp_id', $employee->id],
            ['start_date', '<=', $date]
        ])->orderby('start_date', 'DESC')
        ->first();
        
        return @$employeeJob->basic_salary ? $employeeJob->basic_salary : 0 ;
    }
    
    public static function getPayrollBackDatePeriod($employee)
    {
        return PayrollSetup::where([
            ['key', 'PAYROLL_BACK_DATE_PERIOD'],
            ['company_id', $employee->company_id],
            ['status', 1]
        ])->first();
        
    }
    
    public static function getEisCategory($age, $nationality)
    {
        //not in used
        $category=0;
        
        if ($nationality == 132 && $age < 60) {
            $category = EisCategoryEnum::FIRST_CATEGORY;
        } else if ($nationality != 132) {
            $category = EisCategoryEnum::SECOND_CATEGORY;
        }
        
        return $category;
    }
    
    public static function getSeniorityPay($companyId)
    {
        return PayrollSetup::where([
            ['key', 'SENIORITY_PAY'],
            ['company_id', $companyId],
            ['status', 1]
        ])->first()->value;
    }
    
    public static function getEmployeeBranch($employee, $date)
    {
        $branchName = '';
        $employeeJob = EmployeeJob::where([
            ['emp_id', $employee->id],
            ['start_date', '<=', $date]
        ])->orderby('start_date', 'DESC')
        ->first();
        
        if($employeeJob != null){
            $employeeBranch = EmployeeJob::find($employeeJob->id)->branch->first();
            
            if($employeeBranch != null){
                $branchName = $employeeBranch->name;
            }
        }
        
        return $branchName;
    }
    
    public static function getEmployeeBankAcc($employee)
    {
        $employeeBankAcc = EmployeeBankAccount::where([
            ['emp_id', $employee->id],
            ['acc_status', 'Active']
        ])
        ->whereNull('deleted_at')
        ->first();
        
        return $employeeBankAcc;
    }
    
    public static function getEmployeeContributionYTD($employee, $date)
    {
        $result = DB::table('payroll_master')
            ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->whereYear('payroll_master.year_month', substr($date,0,4))
            ->where([['payroll_trx.employee_id', $employee->id]])
            ->select(
                DB::raw('sum(payroll_trx.employee_epf) as employee_epf_contribution'),
                DB::raw('sum(payroll_trx.employee_eis) as employee_eis_contribution'),
                DB::raw('sum(payroll_trx.employee_socso) as employee_socso_contribution'),
                DB::raw('sum(payroll_trx.employee_pcb) as employee_pcb'),
                DB::raw('sum(payroll_trx.employer_epf) as employer_epf_contribution'),
                DB::raw('sum(payroll_trx.employer_eis) as employer_eis_contribution'),
                DB::raw('sum(payroll_trx.employer_socso) as employer_socso_contribution')
            )
            ->get();
        
        return $result;
    }
    
    public static function getPayrollPeriod($company, $payrollMonth)
    {
        Log::debug("Get Payroll Period");
        Log::debug("Company");
        Log::debug($company);
        Log::debug("Payroll Month: ".$payrollMonth);
        $startDate = null;
        $endDate = null;
        $startDDMMYYYY = null;
        $endDDMMYYYY = null;
        $payrollPeriodArr = array();
        
        $payrollPeriod = PayrollSetup::where([
            ['key', 'PAYROLL_PERIOD'],
            ['company_id', $company->id],
            ['status', 1]
        ])->first();
        Log::debug("Payroll Setup - Payroll Period ");
        Log::debug($payrollPeriod);
        
        if($payrollPeriod != null && $payrollPeriod->value != null) {
            $payrollPeriodValue = explode("-",$payrollPeriod->value);
            $startDate = $payrollPeriodValue[0];
            $endDate = $payrollPeriodValue[1];
            
            if($startDate < 1 || $startDate > 31 || $endDate < 1 || $endDate > 31){
                Log::error("Invalid payroll period: ".$payrollPeriod.", company id: ".$company->id);
            } else {
                $lastDate = date("t", strtotime(DateHelper::getLastDayOfDate($payrollMonth.'-01')));
                Log::debug("Last date of the month; ".$lastDate);
                $endDDMMYYYY = $payrollMonth.'-'.$endDate;
                
                if($endDate > $lastDate){
                    $endDDMMYYYY = $payrollMonth.'-'.$lastDate;
                }
                
                if($startDate < $endDate) {
                    Log::debug("start date < end date");
                    $startDDMMYYYY = $payrollMonth.'-'.$startDate;
                    if($startDate > $lastDate){
                        $startDDMMYYYY = $payrollMonth.'-'.$lastDate;
                    }
                    
                } else {
                    Log::debug("start date > end date");
                    $prevMonth = date('Y-m-d', strtotime($payrollMonth.'-01 -1 month'));
                    $startDDMMYYYY = date("Y-m", strtotime($prevMonth)).'-'.$startDate;
                    $lastDateStartDate = date("t", strtotime(DateHelper::getLastDayOfDate($prevMonth)));
                    if($startDate > $lastDateStartDate){
                        $startDDMMYYYY = date("Y-m", strtotime($prevMonth)).'-'.$lastDateStartDate;
                    }
                }
                array_push($payrollPeriodArr,$startDDMMYYYY,$endDDMMYYYY);
            }
        }
        
        Log::debug("Payroll Period - Start Date: ".$startDDMMYYYY.", End Date: ".$endDDMMYYYY);
        
        return $payrollPeriodArr;
    }
    
    public static function getNumberOfDayPayrollPeriod($startDate, $endDate)
    {
        return date_diff(date_create($startDate), date_create($endDate))->format('%R%a');
    }
}

