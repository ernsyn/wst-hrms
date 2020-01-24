<?php
namespace App\Helpers;

use App\Area;
use App\CostCentre;
use App\Department;
use App\Employee;
use App\Section;
use App\EmployeePosition;
use App\Team;
use App\Category;
use App\EmployeeGrade;
use App\BankCode;
use App\Constants\PermissionConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FilterHelper
{
    public static function getCostCentre()
    {
        return CostCentre::orderBy('name')->get();
    }
    
    public static function getDepartment()
    {
        return Department::orderBy('name')->get();
    }
    
    public static function getSection()
    {
        return Section::orderBy('name')->get();
    }
    
    public static function getPosition()
    {
        return EmployeePosition::orderBy('name')->get();
    }
    
    public static function getTeam()
    {
        return Team::orderBy('name')->get();
    }
    
    public static function getCategory()
    {
        return Category::orderBy('name')->get();
    }
    
    public static function getArea()
    {
        return Area::orderBy('name')->get();
    }
    
    public static function getGrade()
    {
        return EmployeeGrade::orderBy('name')->get();
    }
    
    public static function getBankCode()
    {
        return BankCode::orderBy('name')->get();
    }
    
    public static function getSearchKey($request)
    {
        $arr = array();
        $search = array();
        
        if (isset($request->costCentres)) {
            //             $employees->whereIn('employees.cost_centre_id', $request->costCentres);
            $search['employees.cost_centre_id'] = $request->costCentres;
        }
        
        if (isset($request->departments)) {
            //             $employees->whereIn('employees.department_id', $request->departments);
            $search['employees.department_id'] = $request->departments;
        }
        
        if (isset($request->sections)) {
            //             $employees->whereIn('employees.section_id', $request->sections);
            $search['employees.section_id'] = $request->sections;
        }
        
        if (isset($request->positions)) {
            //             $employees->whereIn('employees.position_id', $request->positions);
            $search['employees.position_id'] = $request->positions;
        }
        
        if (isset($request->teams)) {
            //             $employees->whereIn('employees.team_id', $request->teams);
            $search['employees.team_id'] = $request->teams;
        }
        
        if (isset($request->categories)) {
            //             $employees->whereIn('employees.category_id', $request->categories);
            $search['employees.category_id'] = $request->categories;
        }
        
        if (isset($request->areas)) {
            //             $employees->whereIn('employees.area_id', $request->areas);
            $search['employees.area_id'] = $request->areas;
        }
        
        if (isset($request->grades)) {
            //             $employees->whereIn('employees.grade_id', $request->grades);
            $search['employees.grade_id'] = $request->grades;
        }
        
        if (isset($request->employeeId)) {
            $employeeIds = array_map('trim', explode(',', $request->employeeId));
            //             $employees->whereIn('code', $employeeIds);
            $search['employees.code'] = $employeeIds;
        }
        
        if (isset($request->name)) {
            //             $employeeNames = array_map('trim', explode(',', $request->name));
            //             $employees->whereIn('code', $employeeNames);
            $search['users.name'] = $request->name;
        }
        
        if (isset($request->icNumber)) {
            $search['employees.ic_no'] = $request->icNumber;
        }
        
        if (isset($request->gender)) {
            $search['employees.gender'] = $request->gender;
        }
        
        if (isset($request->bankAccount)) {
            //TODO: all or active only
        }
        
        if (isset($request->bankCodes)) {
            //TODO: all or active only
        }
        
        if (isset($request->epfNumber)) {
            $search['employees.epf_no'] = $request->epfNumber;
        }
        
        if (isset($request->socsoNumber)) {
            $search['employees.socso_no'] = $request->socsoNumber;
        }
        
        if(count($search) > 0) {
            foreach($search as $key => $value) {
                $arr[$key] = $value;
            }
        }
        
        return $arr;
    }
    
    public static function getEmployees(Request $request)
    {
        Log::debug("Get Empoyees: request");
        Log::debug($request);
        $user = Auth::user();
        $currentUser = Employee::where('user_id',Auth::id())->first();
        $securityGroupAccess = AccessControllHelper::getSecurityGroupAccess();
        
        //         $bankAccount = DB::table('employee_bank_accounts')
        //                         ->where('acc_status', 'Active');
        
        $employees = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->leftjoin('cost_centres', 'cost_centres.id', '=', 'employees.cost_centre_id')
            ->leftjoin('departments', 'departments.id', '=', 'employees.department_id')
            ->leftjoin('sections', 'sections.id', '=', 'employees.section_id')
            ->leftjoin('employee_positions', 'employee_positions.id', '=', 'employees.position_id')
            ->leftjoin('teams', 'teams.id', '=', 'employees.team_id')
            ->leftjoin('categories', 'categories.id', '=', 'employees.category_id')
            ->leftjoin('branches', 'branches.id', '=', 'employees.branch_id')
            ->leftjoin('areas', 'areas.id', '=', 'employees.area_id')
            ->leftjoin('employee_grades', 'employee_grades.id', '=', 'employees.grade_id')
            //                         ->leftJoinSub($bankAccount, 'bankAcc', function ($join) {
                //                             $join->on('employees.id', 'bankAcc.emp_id');
                //                         })//leftjoin('employee_bank_accounts', 'employee_bank_accounts.emp_id', 'employees.id')
            ->select('employees.*','users.name as name', 'cost_centres.name as costCentre', 'departments.name as department', 'sections.name as section',
                'employee_positions.name as position', 'teams.name as team', 'areas.name as area', 'employee_grades.name as grade',
                'categories.name as category',
                DB::raw("CONCAT(TIMESTAMPDIFF( YEAR, employees.join_company_date, case when employees.resignation_date is null then now() else employees.resignation_date end),'yr ',
                                    TIMESTAMPDIFF( MONTH, employees.join_company_date, case when employees.resignation_date is null then now() else employees.resignation_date end) % 12,'mth') as serviceYear")
                                    //                             'bankAcc.*'
                )
            ->where(function($query) use($currentUser, $securityGroupAccess){
                $query->whereIn('employees.main_security_group_id', $securityGroupAccess);
            });
        
        $searchOption = self::getSearchKey($request);
        $multiValue = array('employees.cost_centre_id', 'employees.department_id', 'employees.section_id', 'employees.position_id', 'employees.team_id',
            'employees.category_id', 'employees.area_id', 'employees.grade_id', 'employees.code');
        $wildcardValue = array('users.name');
        
        if(count($searchOption) > 0) {
            foreach($searchOption as $key => $value) {
                if(in_array($key, $multiValue)) {
                    $employees->whereIn($key, $value);
                } else if(in_array($key, $wildcardValue)) {
                    $employees->where($key, 'like', '%'.$value.'%');
                } else {
                    $employees->where($key, $value);
                }
            }
        }
        
        if (isset($request->joinGroupDateFrom)) {
            $employees->whereDate('employees.join_group_date', '>=', DateHelper::toMysqlDateFormat($request->joinGroupDateFrom));
        }
        
        if (isset($request->joinGroupDateTo)) {
            $employees->whereDate('employees.join_group_date', '<=', DateHelper::toMysqlDateFormat($request->joinGroupDateTo));
        }
        
        if (isset($request->joinCompanyDateFrom)) {
            $employees->whereDate('employees.join_company_date', '>=', DateHelper::toMysqlDateFormat($request->joinCompanyDateFrom));
        }
        
        if (isset($request->joinCompanyDateTo)) {
            $employees->whereDate('employees.join_company_date', '<=', DateHelper::toMysqlDateFormat($request->joinCompanyDateTo));
        }
        
        if (isset($request->confirmDateFrom)) {
            $employees->whereDate('employees.confirmed_date', '>=', DateHelper::toMysqlDateFormat($request->confirmDateFrom));
        }
        
        if (isset($request->confirmDateTo)) {
            $employees->whereDate('employees.confirmed_date', '<=', DateHelper::toMysqlDateFormat($request->confirmDateTo));
        }
        
        if (isset($request->resignDateFrom)) {
            $employees->whereDate('employees.resignation_date', '>=', DateHelper::toMysqlDateFormat($request->resignDateFrom));
        }
        
        if (isset($request->resignDateTo)) {
            $employees->whereDate('employees.resignation_date', '<=', DateHelper::toMysqlDateFormat($request->resignDateTo));
        }
        
        if (isset($request->serviceYearFrom)) {
            $employees->whereRaw('DATEDIFF(case when employees.resignation_date is null then now() else employees.resignation_date end, employees.join_company_date)/365 >= ? ', array($request->serviceYearFrom));
        }
        
        if (isset($request->serviceYearTo)) {
            $employees->whereRaw('DATEDIFF(case when employees.resignation_date is null then now() else employees.resignation_date end,  employees.join_company_date)/365 <= ? ', array($request->serviceYearTo));
        }
        
        if (isset($request->basicFrom)) {
            $employees->where('employees.basic_salary', '>=', $request->basicFrom);
        }
        
        if (isset($request->basicTo)) {
            $employees->where('employees.basic_salary', '<=', $request->basicTo);
        }
        
        $count = $employees->count();
        
        $dir = 'asc';
        $column = 'cost_centres.name';
        switch ($request->order[0]['column']) {
            case 1:
                $column = 'cost_centres.name';
                break;
            case 2:
                $column = 'employees.code';
                break;
            case 3:
                $column = 'users.name';
                break;
            case 4:
                $column = 'departments.name';
                break;
            case 5:
                $column = 'sections.name';
                break;
            case 6:
                $column = 'employee_positions.name';
                break;
            case 7:
                $column = 'teams.name';
                break;
            case 8:
                $column = 'categories.name';
                break;
            case 9:
                $column = 'areas.name';
                break;
            case 10:
                $column = 'employee_grades.name';
                break;
            case 11:
                $column = 'employees.join_group_date';
                break;
            case 12:
                $column = 'employees.join_company_date';
                break;
            case 13:
                $column = 'employees.confirmed_date';
                break;
            case 14:
                $column = 'employees.resignation_date';
                break;
            case 15:
                $column = 'serviceYear';
                break;
            case 16:
                $column = 'employees.ic_no';
                break;
            case 17:
                $column = 'employees.gender';
                break;
            case 18:
                $column = 'employees.basic_salary';
                break;
            case 19: //TODO: bank acc
                $column = '';
                break;
            case 20: //TODO: bank code
                $column = '';
                break;
            case 21:
                $column = 'employees.epf_no';
                break;
            case 22:
                $column = 'employees.socso_no';
                break;
        }
        
        if(isset($request->order[0]['dir'])) {
            $dir = $request->order[0]['dir'];
        }
        
        $employees->orderBy($column, $dir);
        
        if(isset($request->start)) {
            $employees->offset($request->start);
        }
        
        if(isset($request->length)) {
            $employees->limit($request->length);
        }
         
        $employees = $employees->get();
        
        //         Log::debug($employees);
        
        $data = array();
        foreach($employees as $employee) {
            //             Log::debug($employee);
            $subdata = array();
            $subdata[] = $employee->id;
            $subdata[] = $employee->costCentre;
            $subdata[] = $employee->code;
            $subdata[] = $employee->name;
            $subdata[] = $employee->department;
            $subdata[] = $employee->section;
            $subdata[] = $employee->position;
            $subdata[] = $employee->team;
            $subdata[] = $employee->category;
            $subdata[] = $employee->area;
            $subdata[] = $employee->grade;
            $subdata[] = isset($employee->join_group_date) ? DateHelper::dateStandardFormat($employee->join_group_date) : '';
            $subdata[] = isset($employee->join_company_date) ? DateHelper::dateStandardFormat($employee->join_company_date) : '';
            $subdata[] = isset($employee->confirmed_date) ? DateHelper::dateStandardFormat($employee->confirmed_date) : '';
            $subdata[] = isset($employee->resignation_date) ? DateHelper::dateStandardFormat($employee->confirmed_date) : '';
            $subdata[] = $employee->serviceYear;//null !== PayrollHelper::calculateServiceYear($employee->join_group_date, $employee->resignation_date) ? DateHelper::dateStandardFormat(PayrollHelper::calculateServiceYear($employee->join_group_date, $employee->resignation_date)) : '';
            $subdata[] = $employee->ic_no;
            $subdata[] = ucfirst($employee->gender);
            $subdata[] = $employee->basic_salary;
            $subdata[] = '';//$employee->acc_no;//null !== PayrollHelper::getEmployeeBankAcc($employee) ? PayrollHelper::getEmployeeBankAcc($employee)->acc_no : '';
            $subdata[] = '';//$employee->bank_code;//null !== PayrollHelper::getEmployeeBankAcc($employee) ? PayrollHelper::getEmployeeBankAcc($employee)->bank_code : '';
            $subdata[] = $employee->epf_no;
            $subdata[] = $employee->socso_no;
            
            $button = '';
            if($user->can(PermissionConstant::VIEW_EMPLOYEE)) {
                $button .= ' <button onclick="window.location=\'' .route('admin.employees.id', ['id' => $employee->id]) .'\';" class="btn btn-default btn-smt fas fa-eye" title="View"></button> ';
            }
            
            if($user->can(PermissionConstant::VIEW_ASSET)) {
                $button .= ' <button onclick="window.location=\'' .route('admin.employees.assetid', ['id' => $employee->id]).'\';" class="btn btn-default btn-smt fas fa-hand-holding-usd" title="Asset"></button> ';
            }

            $subdata[] = $button;
            $data[] = $subdata;
        }
        
        return [$employees, $count, $data];
        
    }
}

