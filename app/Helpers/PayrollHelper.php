<?php
namespace App\Helpers;

use App\EmployeeReportTo;
use Illuminate\Support\Facades\Auth;

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
    
    public static function calculateSeniorityPay($employee, $payrollMonth, $jobMaster)
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
        if($jobMaster->first()->seniority_pay == 'Auto' && $diffYears > 0) {
            $seniorityPay = ($diffYears > 0)? getenv('SENIORITY_PAY') * $diffYears : getenv('SENIORITY_PAY');
        }
//         dd($seniorityPay);
        return $seniorityPay;
    }
    
    public static function getPayback($employee, $payrollMonth)
    {
        //todo: retest, currently not in used
        // If status is Resigned, check the contra key
        // If contra is false, then need get the balance of leave * salary / days
        // Else set 0.00
        $payback = 0.00;
        if($employee->status == 'Resigned' && !@$contra) {
            $annualLeave_type = $this->leavetype->findBy_Name('Annual Leave');
            $leave = $this->leave->find(null, $employee->id, $annualLeave_type->id);
            if(!@$leave) {
                $leave = new \stdClass();
                $leave->available_balance = 0;
            }
            $payrollMonth = explode('-', $payrollMonth);
            $days = cal_days_in_month(CAL_GREGORIAN, $payrollMonth[1], $payrollMonth[0]);
            $payback = ($employee->selected_job_salary >= 2000)? ($employee->selected_job_salary / $days) * $leave->available_balance : ($employee->selected_job_salary / 26) * $leave->available_balance;
        }
        
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
    public static function payroll_addition_with_days(){
        return [
            // 'OT'        => 'Overtime',
            'ALP'       => 'Annual Leave Payback',
            'CFLP'      => 'Carry Forward Leave Payback',
            'PH'        => 'Public Holiday',
            'RD'        => 'Rest Day',
        ];
    }
    
    // 20180924 Lin : This is the special cas. For those addition need key in hours,
    // only can calculate the amount of the addition.
    public static function payroll_addition_with_hours(){
        return [
            'OT'        => 'Overtime',
        ];
    }
    
    // 20180921 Lin : This is the special case. For those deduction need key in days,
    // only can calculate the amount of the deduction.
    public static function payroll_deduction_with_days(){
        return [
            'UL'        => 'Unpaid Leave',
        ];
    }
}

