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

    }


    public function displaySetupCompany()
    {       

        $company = Company::all();
        return view('pages.admin.settings.company', ['company'=>$company]);
    }

    public function displayAddCompany()
    {
        return view('pages.admin.settings.add-company');
    }

    public function addSetupCompany(Request $request)
    {
        $name = $request->input('name');
        $url = $request->input('url');       
        $registration_no = $request->input('registration_no');
        $description = $request->input('description');
        $address = $request->input('address');       
        $phone = $request->input('phone');
        $tax_no = $request->input('tax_no');
        $epf_no = $request->input('epf_no');       
        $socso_no = $request->input('socso_no');
        $eis_no = $request->input('eis_no');
        $status = Input::get('status');
        $created_by = auth()->user()->id;
        $code = $request->input('code');
        $updated_by =$request->input('updated_by');
        
       
        // DB::insert('insert into companies
        // (code, name, url, registration_no,
        // description, address, phone,
        // tax_no, epf_no, socso_no,
        // eis_no, status, created_by,
        // updated_by,gst_no) 
        // values
        // (?,?,?,?,
        // ?,?,?,
        // ?,?,?,
        // ?,?,?,
        // ?,?)',
        // [$code, $name, $url, $registration_no,
        // $description, $address, $phone,
        // $tax_no, $epf_no, $socso_no,
        // $eis_no,'Active', $created_by,
        // $created_by,'none']);

        $company = Company::join('employees','employees.id','=','companies.updated_by')
        ->join('users','users.id','=','employees.id')
        ->select('companies.name as name','companies.description as description','companies.logo_media_id as image','companies.tax_no as tax_number',
        'companies.epf_no as epf_number','companies.socso_no as socso_number','companies.eis_no as eis_number',
        'companies.updated_at as updated_on','users.name as EmpName','companies.status as status,')
        ->get();

        $company = Company::all();
        return view('pages.admin.settings.company', ['company'=>$company]);
    }

    public function displaySetupJob()
    {       
        $costs = EmployeeCategory::all();
        $departments = Department::all();
        $teams = Team::all();
        $positions = EmployeePosition::all();
        $grade = EmployeeGrade::all();
        
        return view('pages.admin.settings.job-configure', ['costs'=>$costs, 'departments'=>$departments, 'teams'=>$teams, 'positions'=>$positions, 'grade'=>$grade]);
    }

    public function displaySetupBranch()
    {       
        $branch = Branch::all();
        
        return view('pages.admin.settings.branch', ['branch'=>$branch]);
    }    


    public function addJob(Request $request)
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

    
        

    public function displayCostCentre()
    {
        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
    }

    public function addCostCentre(Request $request)
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

    public function addBranch(Request $request)
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

    public function editCompany(Request $request)
    {     
        $company_id = $request->input('company_id');          
        $name = Input::get('name');   
        $registration_no = Input::get('registration_no');          
        $description = Input::get('description');   
        $url = Input::get('url');          
        $address = Input::get('address');   
        $phone = Input::get('phone');          
        $gst_no = Input::get('gst_no');   
        $tax_no =Input::get('tax_no');          
        $epf_no = Input::get('epf_no');   
        $socso_no =Input::get('socso_no');          
        $eis_no = Input::get('eis_no');   
        $code = Input::get('code');   

        
        Company::where('id',$company_id)->update(
            array('name' => $name,'registration_no' => $registration_no,
            'description' => $description,'url' => $url,
            'address' => $address,'phone' => $phone,
            'gst_no' => $gst_no,'tax_no' => $tax_no,'epf_no' => $epf_no,
            'socso_no' => $socso_no,'eis_no' => $eis_no,'code'=>$code));

        $company = Company::all();
        return view('pages.admin.settings.company', ['company'=>$company]);
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

    public function displayDepartment()
    {
        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }

    public function addDepartment(Request $request)
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

    public function displayTeam()
    {
        $team = Team::all();
        return view('pages.admin.settings.team', ['team'=>$team]);
    }

    public function addTeam(Request $request)
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

    public function displayPosition()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }

    public function addPosition(Request $request)
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

    public function displayGrade()
    {
        $grade = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grade'=>$grade]);
    }

    public function addGrade(Request $request)
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

    public function addCompanyBank(Request $request)
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
       
        return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
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

            return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
    }


    public function addCompanyAddition(Request $request)
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
        return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
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

        return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
    }

    public function addCompanyDeduction(Request $request)
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
        return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
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

        return redirect()->route('/setup/company-details/{id}', ['id' => $company_id]);
    }


    
}
