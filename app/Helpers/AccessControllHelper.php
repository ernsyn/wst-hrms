<?php
namespace App\Helpers;

use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\SecurityGroup;

class AccessControllHelper
{
    public static function isKpiProposer(){
        $isKpiProposer = false;
        $currentUser = Auth::id();
        $employeeReportTo = EmployeeReportTo::join('employees', 'employees.id', '=', 'employee_report_to.report_to_emp_id')
        ->where([['employees.user_id', $currentUser], ['kpi_proposer',1]])->get();
        
//         dd($currentUser);
        if(count($employeeReportTo) > 0){
            $isKpiProposer = true;
        }
//         dd($isKpiProposer);
        return $isKpiProposer;
    }
    
    public static function isHrExec() {
        return Auth::user()->hasRole('hr-exec');
    }
    
    public static function isHrAdmin() {
        return Auth::user()->hasRole('admin');
    }
    
    public static function getSecurityGroupAccess(){
        if(self::isHrAdmin()){
            $securityGroupAccess = SecurityGroup::where('company_id',GenerateReportsHelper::getUserLogonCompanyInfomation()->id)->select('id')->get();
        }else{
            $securityGroupAccess = EmployeeSecurityGroup::where('emp_id',Auth::id())->select('security_group_id')->get();
        }
//         dd($securityGroupAccess,Auth::id());
        return $securityGroupAccess;
    }
    
    public static function hasAnyRoles($role) {
        $roles = is_array($role)
        ? $role
        : explode('|', $role);
        
        if (! Auth::user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }
    }
}
