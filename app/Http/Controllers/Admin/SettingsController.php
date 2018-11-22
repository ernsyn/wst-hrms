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
use App\EPF;
use App\Eis;
use App\Socso;
use App\Pcb;

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

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been added.');
    }

    public function editCompany(Request $request, $id) {
        $company = Company::find($id);

        return view('pages.admin.settings.edit-company', ['company' => $company]);
    }


    public function displayPositions()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }

    public function addPosition()
    {
        return view('pages.admin.settings.add-position');
    }

    public function postAddPosition(Request $request)
    {
        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions',

        ]);

        EmployeePosition::create($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been added.');
    }

    public function editPosition(Request $request, $id) {
        $position = EmployeePosition::find($id);

        return view('pages.admin.settings.edit-position', ['position' => $position]);
    }

    public function postEditPosition(Request $request, $id)
    {

        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions,name,'.$id,

        ]);

        EmployeePosition::where('id', $id)->update($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been updated.');
    }

    public function displayGrades()
    {
        $grades = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grades'=>$grades]);
    }
    public function addGrade()
    {
        return view('pages.admin.settings.add-grade');
    }

    public function postAddGrade(Request $request)
    {
        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades',

        ]);

        EmployeeGrade::create($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been added.');
    }

    public function editGrade(Request $request, $id) {
        $grade = EmployeeGrade::find($id);

        return view('pages.admin.settings.edit-grade', ['grade' => $grade]);
    }

    public function postEditGrade(Request $request, $id)
    {

        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades,name,'.$id,

        ]);

        EmployeeGrade::where('id', $id)->update($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been updated.');
    }


    public function displayTeams()
    {
        $teams = Team::all();
        return view('pages.admin.settings.team', ['teams'=>$teams]);
    }
    public function addTeam()
    {
        return view('pages.admin.settings.add-team');
    }

    public function postAddTeam(Request $request)
    {
        $teamData = $request->validate([
            'name' => 'required|unique:teams',

        ]);

        Team::create($teamData);

        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been added.');
    }

    public function editTeam(Request $request, $id) {

        $team = Team::find($id);

        return view('pages.admin.settings.edit-team', ['team' => $team]);
    }

    public function postEditTeam(Request $request, $id)

       {

            $teamData = $request->validate([
                'name' => 'required|unique:teams,name,'.$id,

            ]);

            Team::where('id', $id)->update($teamData);

            return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been updated.');
        }



        public function displayCostCentres()
        {
            $costs = CostCentre::all();
            return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
        }

        public function addCostCentre()
        {
            return view('pages.admin.settings.add-cost-centre');
        }


        public function postAddCostCentre(Request $request)
        {
            $costCentreData = $request->validate([
                'name' => 'required',
                'seniority_pay' =>'required',

                // 'payroll_type' =>'required'

            ]);

            $costCentreData['amount'] = '50.00';

            CostCentre::create($costCentreData);
            return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been added.');
        }


        public function editBranch(Request $request, $id) {
            $branch = Branch::find($id);

            return view('pages.admin.settings.edit-branch', ['branch' => $branch]);
        }

        public function editCostCentre(Request $request, $id) {
            $costs = CostCentre::find($id);

            return view('pages.admin.settings.edit-cost-centre', ['costs' => $costs]);
        }


        public function postEditCostCentre(Request $request,$id)
        {

            $costCentreData = $request->validate([
                'name' => 'required|unique:cost_centres,name,'.$id,
                'seniority_pay' =>'required',
                // 'payroll_type' =>'required'

            ]);

            CostCentre::where('id', $id)->update($costCentreData);

            return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been updated.');
        }



        public function addDepartment()
        {
            return view('pages.admin.settings.add-department');
        }


        public function postAddDepartment(Request $request)
        {
            $departmentData = $request->validate([
                'name' => 'required'

            ]);
            Department::create($departmentData);
            return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been added.');
        }


        public function editDepartment(Request $request, $id) {
            $department = Department::find($id);

            return view('pages.admin.settings.edit-department', ['department' => $department]);
        }

        public function addWorkingDay()
        {
            return view('pages.admin.settings.add-working-day');
        }


        public function postAddWorkingDay(Request $request)
        {
            $workingDaysData = $request->validate([
                'template_name' => 'required|unique:employee_working_days,template_name,NULL,id,deleted_at,NULL',
                'monday' => 'required',
                'tuesday' => 'required',
                'wednesday' => 'required',
                'thursday' => 'required',
                'friday' => 'required',
                'saturday' => 'required',
                'sunday' => 'required',
            ]);

            $workingDaysData['is_template'] = true;

            EmployeeWorkingDay::create($workingDaysData);
            return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been added.');
        }


    public function editWorkingDay(Request $request, $id) {
        $working_day = EmployeeWorkingDay::templates()->find($id);

        return view('pages.admin.settings.edit-working-day', ['working_day' => $working_day]);
    }

    public function displayBranches()
    {
        $branches = Branch::all();

        return view('pages.admin.settings.branch', ['branches'=>$branches]);
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

    public function addBranch()
    {
        return view('pages.admin.settings.add-branch');
    }




    public function postAddBranch(Request $request)
    {

        $branchData = $request->validate([
            'name' => 'required|unique:branches,name,NULL,id,deleted_at,NULL',
            'contact_no_primary' =>'required|numeric',
            'contact_no_secondary' => 'required|numeric',
            'fax_no' =>'required|numeric',
            'address'=>'required',
            'country_code'=> 'required|numeric',
            'state'=> 'required',
            'city'=>   'required',
            'zip_code'=> 'required|numeric'
        ]);

        Branch::create($branchData);
        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been added.');
    }



    public function postEditDepartment(Request $request,$id)
    {

        $departmentData = $request->validate([
            'name' => 'required|unique:departments,name,'.$id
        ]);

        Department::where('id', $id)->update($departmentData);

        return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been updated.');
    }

    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayData = $request->validate([
            'template_name' => 'required|unique:employee_working_days,template_name,{$id},id,deleted_at,NULL',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
        ]);

        EmployeeWorkingDay::where('id', $id)->update($workingDayData);

        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been updated.');
    }


    public function postEditBranch(Request $request, $id)
    {
        $branchData = $request->validate([
            'name' => 'required|unique:branches,name,'.$id.',id,deleted_at,NULL',
            'contact_no_primary' =>'required|numeric',
            'contact_no_secondary' => 'required|numeric',
            'fax_no' =>'required|numeric',
            'address'=>'required',
            'country_code'=> 'required|numeric',
            'state'=> 'required',
            'city'=>   'required',
            'zip_code'=> 'required|numeric'


            ]);

            Branch::where('id', $id)->update($branchData);

            return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been updated.');
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
            'socso_no' => 'required|numeric',
            'eis_no' => 'required',
            'code' => 'required|unique:companies,code,'.$id,
            'status' => 'required',
        ]);

        Company::where('id', $id)->update($companyData);

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been updated.');
    }

    // Section: DELETE

    public function deleteBranch(Request $request, $id)
    {
        Branch::find($id)->delete();

        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been deleted.');
    }

    public function deleteWorkingDay(Request $request, $id)
    {
        EmployeeWorkingDay::templates()->find($id)->delete();

        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been deleted.');
    }

    public function deletePcb(Request $request, $id)
    {
        Pcb::find($id)->delete();

        return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been deleted.');
    }

    public function displayDepartments()
    {
        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }

    public function displayWorkingDays()
    {
        $working_days = EmployeeWorkingDay::templates()->get();
        return view('pages.admin.settings.working-day', ['working_days'=>$working_days]);
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


// Contribution List
public function displayEpf()
{
    $epf = EPF::all();

    return view('pages.admin.settings.epf', ['epf' => $epf]);
}

public function addEpf()
{
    return view('pages.admin.settings.add-epf');
}

public function postAddEpf(Request $request)
{
    $epfData = $request->validate([
        'category' => 'required',
        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',
        'name'=>'required',

    ]);

    EPF::create($epfData);

    return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been added.');
}

public function editEpf(Request $request, $id) {
    $epf = EPF::find($id);

    return view('pages.admin.settings.edit-epf', ['epf' => $epf]);
}
public function postEditEpf(Request $request, $id)
{

    $epfData = $request->validate([

        'category' => 'required',
        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',
        'name'=>'required',

    ]);

    EPF::where('id', $id)->update($epfData);

    return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been updated.');
}


// Contribution List
public function displayEis()
{
    $eis = Eis::all();
    return view('pages.admin.settings.eis', ['eis' => $eis]);
}

public function addEis()
{
    return view('pages.admin.settings.add-eis');
}

public function postAddEis(Request $request)
{
    $eisData = $request->validate([

        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',


    ]);

    Eis::create($eisData);

    return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been added.');
}

public function editEis(Request $request, $id) {
    $eis = Eis::find($id);

    return view('pages.admin.settings.edit-eis', ['eis' => $eis]);
}

public function postEditEis(Request $request, $id)
{

    $eisData = $request->validate([

        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',

    ]);

    Eis::where('id', $id)->update($eisData);

    return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been updated.');
}


// Contribution List
public function displaySocso()
{
    $socso = Socso::all();
    return view('pages.admin.settings.socso', ['socso' => $socso]);
}

public function addSocso()
{
    return view('pages.admin.settings.add-socso');
}

public function postAddSocso(Request $request)
{
    $socsoData = $request->validate([

        'salary' => 'required',
        'first_category_employer' => 'required',
        'first_category_employee' => 'required',


    ]);

    Socso::create($socsoData);

    return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been added.');
}

public function editSocso(Request $request, $id) {
    $socso = Socso::find($id);

    return view('pages.admin.settings.edit-socso', ['socso' => $socso]);
}

public function postEditSocso(Request $request, $id)
{

    $socsoData = $request->validate([

        'salary' => 'required',
        'first_category_employer' => 'required',
        'first_category_employee' => 'required',

    ]);

    Socso::where('id', $id)->update($socsoData);

    return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been updated.');
}


// Contribution List
public function displayPcb()
{
    $pcbs = Pcb::all();
    return view('pages.admin.settings.pcb', ['pcbs' => $pcbs]);
}

public function addPcb()
{
    return view('pages.admin.settings.add-pcb');
}

public function postAddPcb(Request $request)
{
    $pcbData = $request->validate([
        'category' => 'required|unique:pcbs,category,NULL,id,deleted_at,NULL',
        'salary' => 'required|numeric',
        'amount' => 'required|numeric',
        'total_children' =>'required|numeric',
    ]);

    Pcb::create($pcbData);

    return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been added.');
}

public function editPcb(Request $request, $id) {
    $pcbs = Pcb::find($id);

    return view('pages.admin.settings.edit-pcb', ['pcbs' => $pcbs]);
}

public function postEditPcb(Request $request, $id)
{

    $pcbData = $request->validate([
        'category' => 'required|unique:pcbs,category,{$id},id,deleted_at,NULL',
        'salary' => 'required',
        'amount' => 'required',
        'total_children' =>'required',

    ]);

    Pcb::where('id', $id)->update($pcbData);

    return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been updated.');
}


}
