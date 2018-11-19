<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeAttachment;
use App\EmployeeBankAccount;
use App\EmployeeDependent;
use App\EmployeeEducation;
use App\EmployeeEmergencyContact;
use App\EmployeeExperience;
use App\EmployeeGrade;
use App\EmployeeBank;
use App\EmployeeImmigration;
use App\EmployeeJob;
use App\EmployeeLanguange;
use App\EmployeePosition;
use App\EmployeeSkill;
use App\EmployeeSupervisor;
use App\EmployeeVisa;
use App\EmployeeWorkingDay;
use App\Company;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\Team;
use App\LeaveRequest;
use App\LeaveType;
use App\LeaveBalance;
use App\Country;
use App\Employee;
use App\Holiday;
use App\CompanyBank;
use App\SecurityGroup;
use App\Addition;
use App\Deduction;
use App\Bank;
use App\EaForm;

use DB;
use App\User;
use App\EmployeeInfo;
use \Crypt;
use Session;
use Illuminate\Support\Facades\Input;
use \DateTime;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    // SECTION: Display





    // SECTION: Add

    public function displayCompanies()
    {       
        $companies = Company::all();
        return view('pages.admin.settings.company', ['companies' => $companies]);
    }

    public function addCompany()
    {
        return view('pages.admin.settings.add-company');
    }

    public function postAddCompany(Request $request)
    {
        $companyData = $request->validate([
            'name' => 'required|unique:companies',
            'url' => 'required',
            'registration_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'tax_no' => 'required',
            'epf_no' => 'required',
            'socso_no' => 'required',
            'eis_no' => 'required',
            'code' => 'required|unique:companies',
        ]);

        $companyData['status'] = 'active';

        Company::create($companyData);

        return redirect()->route('admin.settings.companies');
    }
    

    public function displayBranches()
    {       
        $branch = Branch::all();
        
        return view('pages.admin.settings.branch', ['branch'=>$branch]);
    }    

    
    public function displayJobs()
    {       
        $costs = EmployeeCategory::all();
        $departments = Department::all();
        $teams = Team::all();
        $positions = EmployeePosition::all();
        $grade = EmployeeGrade::all();
        
        return view('pages.admin.settings.job-configure', ['costs'=>$costs, 'departments'=>$departments, 'teams'=>$teams, 'positions'=>$positions, 'grade'=>$grade]);
    }

    public function postAddJob(Request $request)
    {          
        $user_id = Session::get('user_id');
        $user = Employee::where('user_id', $user_id)->first(); 

        $basic_salary = $request->input('basic_salary');
        $cost_centre = Input::get('cost_centre');
        $department = Input::get('department');
        $team = Input::get('team');
        $position = Input::get('position');
        $grade = Input::get('grade');
        $branch = Input::get('branch');
        $start_date = $request->input('jobDate');
        $emp_status = Input::get('emp_status');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_jobs
        (emp_id, branch_id, specification,
        emp_mainposition_id, department_id, team_id,
        cost_centre_id, emp_grade_id,start_date,
        basic_salary, status, created_by) 
        values
        (?,?,?,
        ?,?,?,
        ?,?,?,
        ?,?,?)',
        [$user->id, $branch, 'auto',
        $position, $department, $team,
        $cost_centre, $grade, $start_date,
        $basic_salary, $emp_status, $created_by]);

        return redirect()->route('admin/profile-employee/{id}',['id'=>$user_id]); 
    }

    public function editJob(Request $request)
    {          
        $user_id = Session::get('user_id');
        $user = Employee::where('user_id', $user_id)->first(); 

        $job_id = $request->input('job_id');
        $basic_salary = $request->input('basic_salary');
        $cost_centre = Input::get('cost_centre');
        $department = Input::get('department');
        $team = Input::get('team');
        $position = Input::get('position');
        $grade = Input::get('grade');
        $branch = Input::get('branch');
        $start_date = $request->input('jobDate');
        $emp_status = Input::get('emp_status');
        $created_by = auth()->user()->id;      
       
        EmployeeJob::where('id',$job_id)->update(array(
            'branch_id' => $branch,
            'emp_mainposition_id' => $position,
            'department_id' => $department,
            'team_id' => $team,
            'cost_centre_id' => $cost_centre,
            'emp_grade_id' => $grade,
            'start_date' => $start_date,
            'basic_salary' => $basic_salary,
            'status' => $emp_status
        ));

        return redirect()->route('admin/profile-employee/{id}',['id'=>$user_id]); 
    }

    public function employeeResign()
    {   
        $user_id = Session::get('user_id');
        $user = Employee::where('user_id', $user_id)->first();

        EmployeeJob::where('emp_id',$user->id)->update(array(
            'status' => 'resign'
        ));
        
        return redirect()->route('admin/profile-employee/{id}',['id'=>$user_id]);        
    }

    
        

    public function displayCostCentres()
    {
        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
    }

    public function postAddCostCentre(Request $request)
    {     
        $category_name = $request->input('category_name');             
        $seniority_pay = Input::get('seniority_pay');        
        $payroll_type = Input::get('payroll_type');    
        $created_by = auth()->user()->id;
       
        DB::insert('insert into cost_centres
        (name, seniority_pay, payroll_type, created_by,amount) 
        values
        (?,?,?,?,50)',
        [$category_name, $seniority_pay, $payroll_type, $created_by]);

        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
    }

    public function postAddBranch(Request $request)
    {     
        $name = $request->input('name');             
        $contact_no_primary = Input::get('contact_no_primary');        
        $contact_no_secondary = Input::get('contact_no_secondary');    
        $contact_fax = Input::get('contact_fax');        
        $address = Input::get('address'); 

        $code = Input::get('code');        
        $state = Input::get('state');    
        $city = Input::get('city');        
        $zip_code = Input::get('zip_code'); 
        $created_by = auth()->user()->id;
       
        DB::insert('insert into branches
        (name, contact_no_primary,
        contact_no_secondary, fax_no,
        address,country_code, state,city,
        zip_code,created_by    
        )
        values
        (?,?,
        ?,?,
        ?,?,?,?,
        ?,?)',
        [$name,$contact_no_primary,
        $contact_no_secondary,$contact_fax,
        $address,$code,$state,$city,
        $zip_code,$created_by]);

        $branch = Branch::all();
        return view('pages.admin.settings.branch', ['branch'=>$branch]);
    }

    public function editCostCentre(Request $request)
    {     
        $cost_id = $request->input('cost_id');          
        $seniority_pay = Input::get('seniority_pay');   
        $payroll_type = Input::get('payroll_type');   
        
        CostCentre::where('id',$cost_id)->update(
            array('seniority_pay' => $seniority_pay,
            'payroll_type' => $payroll_type));

        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
    }




    public function editDepartment(Request $request)
    {     
        $department_id = $request->input('department_id');          
        $department_name = Input::get('department_name');   

        
        Department::where('id',$department_id)->update(
            array('name' => $department_name));

        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }

    public function editTeam(Request $request)
    {     
        $team_id = $request->input('team_id');          
        $name = Input::get('name');   

        
        Team::where('id',$team_id)->update(
            array('name' => $name));

        $team = Team::all();
        return view('pages.admin.settings.team', ['team'=>$team]);
    }

    public function editBranch(Request $request)
    {     
        $branch_id = $request->input('branch_id');          
        $name = Input::get('name');   
        $contact_no_primary = Input::get('contact_no_primary');          
        $contact_no_secondary = Input::get('contact_no_secondary');   
        $fax_no = Input::get('fax_no');          
        $address = Input::get('address');   
        $state = Input::get('state');          
        $city = Input::get('city');   
        $zip_code =Input::get('zip_code');          
        $country_code = Input::get('country_code');   

        
        Branch::where('id',$branch_id)->update(
            array('name' => $name,'contact_no_primary' => $contact_no_primary,
            'contact_no_secondary' => $contact_no_secondary,'fax_no' => $fax_no,
            'address' => $address,'state' => $state,
            'city' => $city,'zip_code' => $zip_code,'country_code' => $country_code));

        $branch = Branch::all();
        return view('pages.admin.settings.branch', ['branch'=>$branch]);
    }

    public function editCompany(Request $request, $id) {
        $company = Company::find($id);

        return view('pages.admin.settings.edit-company', ['company' => $company]);
    }

    public function postEditCompany(Request $request, $id)
    {              
       
        $companyData = $request->validate([
            'name' => 'required|unique:companies,name,'.$id,
            'url' => 'required',
            'registration_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'tax_no' => 'required',
            'epf_no' => 'required',
            'socso_no' => 'required',
            'eis_no' => 'required',
            'code' => 'required|unique:companies,code,'.$id,
            'status' => 'required',
        ]);

        Company::where('id', $id)->update($companyData);
       
        return redirect()->route('admin.settings.companies');
    }


    public function editPosition(Request $request)
    {     
        $position_id = $request->input('position_id');          
        $name = Input::get('name');   

        
        EmployeePosition::where('id',$position_id)->update(array('name' => $name));

        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }

    public function editGrade(Request $request)
    {     
        $grade_id = $request->input('grade_id');          
        $name = Input::get('name');   

        
        EmployeeGrade::where('id',$grade_id)->update(array('name' => $name));

        $grade = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grade'=>$grade]);
    }

    public function displayDepartments()
    {
        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }

    public function postAddDepartment(Request $request)
    {        
        $name = $request->input('name');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into departments
        (name, created_by) 
        values
        (?,?)',
        [$name, $created_by]);

        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }

    public function displayTeams()
    {
        $team = Team::all();
        return view('pages.admin.settings.team', ['team'=>$team]);
    }

    public function postAddTeam(Request $request)
    {    
        $team_name = $request->input('team_name');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into teams
        (name, created_by) 
        values
        (?,?)',
        [$team_name, $created_by]);

        $team = Team::all();
        return view('pages.admin.settings.team', ['team'=>$team]);
    }

    public function displayPositions()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }

    public function postAddPosition(Request $request)
    {          
        $name = $request->input('name');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_positions
        (name, created_by) 
        values
        (?,?)',
        [$name, $created_by]);

        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }

    public function displayGrades()
    {
        $grade = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grade'=>$grade]);
    }

    public function postAddGrade(Request $request)
    {          
        $name = $request->input('name');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_grades
        (name, created_by) 
        values
        (?,?)',
        [$name, $created_by]);

        $grade = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grade'=>$grade]);
    }

    public function displayCompanyDetails($id)
    {       
        Session::put('company_id', $id);

        $bank = CompanyBank::join('bank_code','bank_code.bank_code','=','company_bank.bank_code')
        ->select('company_bank.id as id', 'company_bank.account_name','bank_code.name as bank_code_name','company_bank.status','bank_code.id as bank_id','bank_code.bank_code as bank_code')
        ->where('company_bank.id_company_master', $id)
        ->get();

        $security = SecurityGroup::where('company_id', $id)->get();
        $additions = Addition::where('id_company_master', $id)->get();
        $deductions = Deduction::where('id_company_master', $id)->get();       

        $bank_list = Bank::all();
        $ea_form = EaForm::all();
        $cost_centre = CostCentre::all();
        $grade = EmployeeGrade::all();

        return view('pages.admin.settings.company.company-details', ['bank'=>$bank, 'bank_list'=>$bank_list, 'grade'=>$grade,
        'security'=>$security, 'additions'=>$additions, 'deductions'=>$deductions, 'ea_form'=>$ea_form, 'cost_centre'=>$cost_centre]);
    }

    public function postAddCompanyBank(Request $request)
    {         
        $company_id = Session::get('company_id');
        $account_name = $request->input('account_name');
        $bank_list = Input::get('bank_list');   
        $status = Input::get('status');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into company_bank
        (id_company_master, account_name, bank_code, status, created_by) 
        values
        (?,?,?,?,?)',
        [$company_id, $account_name, $bank_list, $status, $created_by]);
       
        return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }

    public function editCompanyBank(Request $request)
    {          
        $company_id = Session::get('company_id');

        $company_bank_id = $request->input('company_bank_id');        
        $account_name = $request->input('account_name');
        $bank_list = Input::get('bank_list');   
        $status = Input::get('status');
       
        CompanyBank::where('id',$company_bank_id)->update(
            array('account_name' => $account_name,
            'bank_code' => $bank_list,
            'status' => $status));

            return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }


    public function postAddCompanyAddition(Request $request)
    {         
        $company_id = Session::get('company_id');

        $code = $request->input('code');
        $name = $request->input('name');
        $type = Input::get('type');
        $amount = $request->input('amount');
        $statutory = implode(",", $request->get('statutory'));
        $applies = implode(",", $request->get('applies'));
        $cost_centre = implode(",", $request->get('cost_centre'));
        $job_grade = implode(",", $request->get('job_grade'));
        $ea_form = Input::get('ea_form');
        $status = Input::get('status');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into additions
        (id_company_master, code, name, type, amount, statutory, id_EaForm, status, created_by,
        id_applies_to, id_cost_centre, id_job_master) 
        values
        (?,?,?,?,?,?,?,?,?,
        ?,?,?)',
        [$company_id, $code, $name, $type, $amount, $statutory, $ea_form, $status, $created_by,
        $applies, $cost_centre, $job_grade]);

        //---- view -------
        return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }

    public function editCompanyAddition(Request $request)
    {          
        $company_id = Session::get('company_id');
        $company_addition_id = $request->input('company_addition_id');  
        $code = $request->input('code');
        $name = $request->input('name');
        $type = Input::get('type');
        $amount = $request->input('amount');
        $statutory = implode(",", $request->get('statutory'));
        $applies = implode(",", $request->get('applies'));
        $cost_centre = implode(",", $request->get('cost_centre'));
        $job_grade = implode(",", $request->get('job_grade'));
        $ea_form = Input::get('ea_form');
        $status = Input::get('status');

        Addition::where('id',$company_addition_id)->update(
            array(
            'code' => $code,
            'name' => $name,
            'type' => $type,
            'amount' => $amount,
            'statutory' => $statutory,
            'id_EaForm' => $ea_form,
            'status' => $status,
            'id_applies_to' => $applies,
            'id_cost_centre' => $cost_centre,
            'id_job_master' => $job_grade
        ));

        return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }

    public function postAddCompanyDeduction(Request $request)
    {         
        $company_id = Session::get('company_id');

        $code = $request->input('code');
        $name = $request->input('name');
        $type = Input::get('type');
        $amount = $request->input('amount');
        $statutory = implode(",", $request->get('statutory'));
        $applies = implode(",", $request->get('applies'));
        $cost_centre = implode(",", $request->get('cost_centre'));
        $job_grade = implode(",", $request->get('job_grade'));
        $status = Input::get('status');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into deductions
        (id_company_master, code, name, type, amount, statutory, status, created_by,
        id_applies_to, id_cost_centre, id_job_master) 
        values
        (?,?,?,?,?,?,?,?,
        ?,?,?)',
        [$company_id, $code, $name, $type, $amount, $statutory, $status, $created_by,
        $applies, $cost_centre, $job_grade]);

        //---- view -------
        return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }


    public function editCompanyDeduction(Request $request)
    {          
        $company_id = Session::get('company_id');
        $company_deduction_id = $request->input('company_deduction_id');  
        $code = $request->input('code');
        $name = $request->input('name');
        $type = Input::get('type');
        $amount = $request->input('amount');
        $statutory = implode(",", $request->get('statutory'));
        $applies = implode(",", $request->get('applies'));
        $cost_centre = implode(",", $request->get('cost_centre'));
        $job_grade = implode(",", $request->get('job_grade'));
        $status = Input::get('status');

        Deduction::where('id',$company_deduction_id)->update(
            array(
            'code' => $code,
            'name' => $name,
            'type' => $type,
            'amount' => $amount,
            'statutory' => $statutory,
            'status' => $status,
            'id_applies_to' => $applies,
            'id_cost_centre' => $cost_centre,
            'id_job_master' => $job_grade
        ));

        return redirect()->route('/settings/company-details/{id}', ['id' => $company_id]);
    }


}
