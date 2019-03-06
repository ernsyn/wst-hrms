<?php
namespace App\Helpers;

use App\EmployeeAttendance;
use App\LeaveAllocation;
use App\PayrollSetup;
use App\EmployeeJob;
use App\Enums\EisCategoryEnum;
use App\Enums\SocsoCategoryEnum;
use App\EmployeeBankAccount;
use DB;

class PayrollHelper
{
    public static function calculateSalary($employee, $payrollMonth)
    {
        /*
         * If worked for full month, use full basic salary.
         * If worked for less than a full moth (eg. Those joined the company on 5th of April)
         * - Basic salary / calendar days on that month * number of days worked in that month
         */
        $basicSalary = $employee->basic_salary;
        $payrollStartDate = date_create($payrollMonth.'-01');//var_dump($payrollStartDate);
        $employeeJoinedDate = date_create($employee->start_date);//var_dump($employeeJoinedDate);
        $dateDiff = date_diff($payrollStartDate, $employeeJoinedDate)->format('%R%a');
        //var_dump($dateDiff);
        if($dateDiff >= 0) {
            $payrollMonth = explode('-', $payrollMonth);
            $calendarDays = cal_days_in_month(CAL_GREGORIAN, $payrollMonth[1], $payrollMonth[0]);
            $numOfDaysWorked = $calendarDays - $dateDiff;
            $basicSalary = $basicSalary / $calendarDays * $numOfDaysWorked;
        }
        
        return $basicSalary;
    }
    
    public static function calculateSeniorityPay($employee, $payrollMonth, $costCentre)
    {
        // Start date of the month
        $beginDate = date_create($payrollMonth.'-01');
        $joinedDate = date_create($employee->start_date);
        // Diff of the month/year and joined date
        $diff = date_diff($joinedDate, $beginDate);
        $diffYears = $diff->format('%R%y');
//         var_dump($jobMaster);
        // If seniority pay is Auto,
        // then directly set 50 via .env
        // Else set to 0.00 and let admin to enter later
        $seniorityPay = 0.00;
//         dd($diffYears);
        if($costCentre->first()->seniority_pay == 'Auto' && $diffYears > 0) {
            $defaultSeniorityPay = PayrollSetup::where([
                ['key', 'SENIORITY_PAY'],
                ['company_id', $employee->company_id],
                ['status', 1]
            ])->first();
            $seniorityPay = ($diffYears > 0)? $defaultSeniorityPay->value * $diffYears : $defaultSeniorityPay->value;
        }
//         dd($seniorityPay);
        return $seniorityPay;
    }
    
    public static function getALPayback($employee, $payrollMonth, $leaveBalance)
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
                $days = DateHelper::getNumberDaysInMonth($payrollMonth);
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
    public static function isConfirmedEmployee($employee, $payrollMonth) 
    {
        if($employee->confirmed_date == null || $employee->confirmed_date > DateHelper::getLastDayOfDate($payrollMonth)){
            return false;
        } else {
            return true;
        }
        
    }
    
    //check if resigned for that payroll month
    public static function isResigned($employee, $payrollMonth) 
    {
        //         dd($employee->resignation_date);
        if($employee->resignation_date == null || $employee->resignation_date > DateHelper::getLastDayOfDate($payrollMonth)){
            return false;
        } else {
            return true;
        }
        
    }
    
    //get AL balance for a payroll month
    public static function getALBalance($employee, $payrollMonth)
    {
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
    
    public static function getEisCategory($employee)
    {
        $category=0;
        
        if ($employee->nationality == 132 && self::getAge($employee->dob) < 60 && $employee->eis_no != null) {
            $category = EisCategoryEnum::FIRST_CATEGORY;
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
        $employeeJob = EmployeeJob::where([
            ['emp_id', $employee->id],
            ['start_date', '<=', $date]
        ])->orderby('start_date', 'DESC')
        ->first();
        
        $employeeBranch = EmployeeJob::find($employeeJob->id)->branch->first();
        return @$employeeBranch->name ? $employeeBranch->name : '' ;
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
}

