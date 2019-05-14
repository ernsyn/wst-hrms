<?php
namespace App\Helpers;

use App\Employee;
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\SecurityGroup;
use App\Roles;
use App\EmployeeJob;

class AccessControllHelper
{
    public static function isKpiProposer()
    {
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
    
    public static function hasHrExecRole() 
    {
        return Auth::user()->hasRole('hr-exec');
    }
    
    public static function hasHrAdminRole() 
    {
        return Auth::user()->hasRole('admin');
    }
    
    public static function hasSuperadminRole()
    {
        return Auth::user()->hasRole('super-admin');
    }
    
    public static function getSecurityGroupAccess()
    {
        $securityGroupId = array();
        
        if(self::hasHrAdminRole()){
            $securityGroupAccess = SecurityGroup::where('company_id',GenerateReportsHelper::getUserLogonCompanyInformation()->id)->select('id')->get();
        }else{
            $securityGroupAccess = EmployeeSecurityGroup::where('emp_id',Employee::where('user_id',Auth::id())->first()->id)->select('security_group_id')->get();
        }
        
        foreach($securityGroupAccess as $s){
            array_push($securityGroupId, $s->id);
        }
        
        return $securityGroupId;
    }
    
    public static function hasAnyRoles($role) 
    {
        $roles = is_array($role)
        ? $role
        : explode('|', $role);
        
        if (! Auth::user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }
    }
    
    public static function getRoles() 
    {
        $excludedRoles = array("employee", "super-admin"); 
        $roles = Roles::whereNotIn('name',$excludedRoles)->orderBy('name')->get();
        
        return $roles;
    }
    
    public static function hasPayrollAccess()
    {
        if(! (self::hasHrAdminRole() || self::hasHrExecRole() || self::isKpiProposer())) {
            $roles = array('admin', 'hr-exec', 'kip-proposer');
            throw UnauthorizedException::forRoles($roles);
        }
    }
    
    public static function getCurrentUserLogon(){
        $id = Auth::id();
        return User::find($id);
    }
    
    public static function isResigned()
    {
        $isResigned = false;
        $currentUser = Auth::id();
        $job = EmployeeJob::join('employees', 'employees.id', '=', 'employee_jobs.emp_id')
            ->where([['employees.user_id', $currentUser], ['employee_jobs.status','Resigned']])
            ->orderBy('employee_jobs.id', 'desc')
            ->first();
        
        //         dd($currentUser);
        if(!empty($job)){
            $isResigned = true;
        }
        return $isResigned;
    }
}

