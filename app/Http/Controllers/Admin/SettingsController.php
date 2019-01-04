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
// use App\LeaveBalance;
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
use App\CompanyTravelAllowance;
use App\Imports\PcbImport;

use DB;
use App\User;
use App\EmployeeInfo;
use \Crypt;
use Session;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
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
            'name' => 'required|unique:companies,name,NULL,id,deleted_at,NULL',
            'url' => 'required|url',
            'registration_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'phone' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'tax_no' => 'required|numeric',
            'epf_no' => 'required|numeric',
            'socso_no' => 'required|numeric',
            'eis_no' => 'required|numeric',
            'code' => 'required|unique:companies',
			'postcode' => 'required|numeric'		],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'        ]);

        $companyData['status'] = 'Active';

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
            'name' => 'required|unique:employee_positions,name,NULL,id,deleted_at,NULL',

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
            'name' => 'required|unique:employee_positions,name,'.$id.',id,deleted_at,NULL',
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
            'name' => 'required|unique:employee_grades,name,NULL,id,deleted_at,NULL',

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
            'name' => 'required|unique:employee_grades,name,'.$id.',id,deleted_at,NULL',

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
            'name' => 'required|unique:teams,name,NULL,id,deleted_at,NULL',
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
                'name' => 'required|unique:teams,name,'.$id.',id,deleted_at,NULL',

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
                'name' => 'required|unique:cost_centres,name,NULL,id,deleted_at,NULL',
                'seniority_pay' =>'required'

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
                'name' => 'required|unique:cost_centres,name,'.$id.',id,deleted_at,NULL',
                'seniority_pay' =>'required',
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
                'name' => 'required|unique:departments,name,NULL,id,deleted_at,NULL'

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
        (emp_id, branch_id, remarks,
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
            'contact_no_primary' =>'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'contact_no_secondary' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'fax_no' =>'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'address'=>'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'country_code'=> 'nullable|integer',
            'state'=> 'required',
            'city'=>   'required',
            'zip_code'=> 'required|numeric|digits:5'
        ],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        Branch::create($branchData);
        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been added.');
    }



    public function postEditDepartment(Request $request,$id)
    {

        $departmentData = $request->validate([
            'name' => 'required|unique:departments,name,'.$id.',id,deleted_at,NULL'
        ]);

        Department::where('id', $id)->update($departmentData);

        return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been updated.');
    }

    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayData = $request->validate([
            'template_name' => "required|unique:employee_working_days,template_name,{$id},id,deleted_at,NULL",
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
        ]);

        EmployeeWorkingDay::templates()->where('id', $id)->update($workingDayData);

        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been updated.');
    }


    public function postEditBranch(Request $request, $id)
    {
        $branchData = $request->validate([
            'name' => 'required|unique:branches,name,'.$id.',id,deleted_at,NULL',
            'contact_no_primary' =>'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'contact_no_secondary' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'fax_no' =>'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'address'=>'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'country_code'=> 'nullable|integer',
            'state'=> 'required',
            'city'=>   'required',
            'zip_code'=> 'required|numeric|digits:5'


            ],
            [
                'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
            ]);

            Branch::where('id', $id)->update($branchData);

            return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been updated.');
    }



    public function postEditCompany(Request $request, $id)
    {

        $companyData = $request->validate([
            'name' => 'required|unique:companies,name,'.$id.',id,deleted_at,NULL',
            'url' => 'required|url',
            'registration_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'phone' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'tax_no' => 'required|numeric',
            'epf_no' => 'required|numeric',
            'socso_no' => 'required|numeric',
            'eis_no' => 'required|numeric',
            'code' => 'required|unique:companies,code,'.$id,
            'status' => 'required',
			'postcode' => 'required|numeric'		],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        Company::where('id', $id)->update($companyData);

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been updated.');
    }

    // Section: DELETE
    public function deleteCostCentre(Request $request, $id)
    {
        CostCentre::find($id)->delete();

        return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been deleted.');
    }

    public function deleteDepartment(Request $request, $id)
    {
        Department::find($id)->delete();

        return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been deleted.');
    }

    public function deleteGrade(Request $request, $id)
    {
        EmployeeGrade::find($id)->delete();

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been deleted.');
    }

    public function deleteCompany(Request $request, $id)
    {
        Company::find($id)->delete();

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been deleted.');
    }

    public function deleteTeam(Request $request, $id)
    {
        Team::find($id)->delete();

        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been deleted.');
    }

    public function deleteBranch(Request $request, $id)
    {
        Branch::find($id)->delete();

        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been deleted.');
    }

    public function deletePosition(Request $request, $id)
    {
        EmployeePosition::find($id)->delete();

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been deleted.');
    }

    public function deleteWorkingDay(Request $request, $id)
    {
        EmployeeWorkingDay::templates()->find($id)->delete();

        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been deleted.');
    }

    public function deleteEpf(Request $request, $id)
    {
        EPF::find($id)->delete();

        return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been deleted.');
    }

    public function deleteEis(Request $request, $id)
    {
        Eis::find($id)->delete();

        return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been deleted.');
    }

    public function deleteSocso(Request $request, $id)
    {
        Socso::find($id)->delete();

        return redirect()->route('admin.settings.socso')->with('status', 'Socso has successfully been deleted.');
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
       $bank = CompanyBank::where('company_id', $id)->get();



        $company=Company::where('id', $id)->get();

        $security = SecurityGroup::where('company_id', $id)->get();
        $additions = Addition::where('company_id', $id)->get();
        $deductions = Deduction::where('company_id', $id)->get();
        $company_travel_allowance = CompanyTravelAllowance::where('company_id', $id)->get();
    //    $employee = Employee::with('user', 'employee_jobs')->find($id);

        $bank_list = Bank::all();
        $ea_form = EaForm::all();
        $cost_centre = CostCentre::all();
        $grade = EmployeeGrade::all();





        return view('pages.admin.settings.company.company-details', ['bank'=>$bank, 'bank_list'=>$bank_list, 'grade'=>$grade,
        'security'=>$security, 'additions'=>$additions,'deductions'=>$deductions, 'ea_form'=>$ea_form, 'cost_centre'=>$cost_centre,'company'=>$company,
        'company_travel_allowance'=>$company_travel_allowance,]);


        return view('pages.admin.settings.company.company-details', ['bank' => $bank]);


    }


// Contribution List
public function displayEpf()
{
    $epfs = EPF::all();

    return view('pages.admin.settings.epf', ['epfs' => $epfs]);
}

public function addEpf()
{
    return view('pages.admin.settings.add-epf');
}

public function postAddEpf(Request $request)
{
    $epfData = $request->validate([
        'category' => 'required|unique:epfs,category',
        'salary' => 'required|numeric',
        'employer' => 'required|numeric',
        'employee' => 'required|numeric',
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
        // 'category' => 'required|unique:epfs,category,'.$id.',id,deleted_at,NULL',
        'category' =>  'unique:epfs,category,'.$id.',id,deleted_at,NULL',
        'salary' => 'required|numeric',
        'employer' => 'required|numeric',
        'employee' => 'required|numeric',
        'name'=>'required',

    ]);

    EPF::where('id', $id)->update($epfData);

    return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been updated.');
}


// Contribution List
public function displayEis()
{
    $eiss = Eis::all();
    return view('pages.admin.settings.eis', ['eiss' => $eiss]);
}

public function addEis()
{
    return view('pages.admin.settings.add-eis');
}

public function postAddEis(Request $request)
{
    $eisData = $request->validate([
        'salary' => 'required|numeric',
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

        'salary' => 'required|numeric',
        'employer' => 'required',
        'employee' => 'required',

    ]);

    Eis::where('id', $id)->update($eisData);

    return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been updated.');
}


// Contribution List
public function displaySocso()
{
    $socsos = Socso::all();
    return view('pages.admin.settings.socso', ['socsos' => $socsos]);
}

public function addSocso()
{
    return view('pages.admin.settings.add-socso');
}

public function postAddSocso(Request $request)
{
    $socsoData = $request->validate([

        'salary' => 'required|numeric',
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

        'salary' => 'required|numeric',
        'first_category_employer' => 'required',
        'first_category_employee' => 'required',

    ]);

    Socso::where('id', $id)->update($socsoData);

    return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been updated.');
}


// Contribution List
public function displayPcb()
{
//     $pcbs = Pcb::all();//limit(1000)->get();
//     dd($pcbs);
    return view('pages.admin.settings.pcb');//, ['pcbs' => $pcbs]);
}

public function getPcbData()
{
    $pcbs = Pcb::query();//Pcb::select(['id', 'category', 'salary', 'total_children', 'amount'])->get();
    
    return Datatables::of($pcbs)
    ->addColumn('action', function ($pcbs) {
        return '<button onclick="window.location=\''.url('/admin/settings/pcb/'.$pcbs->id.'/edit').'\'" class="btn btn-success btn-smt fas fa-edit">
    </button>
    <button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title="'.$pcbs->category .'" data-link="'.url('/admin/settings/pcb/'.$pcbs->id.'/delete').'" class="btn btn-danger btn-smt fas fa-trash-alt">
    </button>';
    })
    ->make(true);
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
        'category' => 'required|unique:pcbs,category,'.$id.',id,deleted_at,NULL',
        'salary' => 'required',
        'amount' => 'required',
        'total_children' =>'required',

    ]);

    Pcb::where('id', $id)->update($pcbData);

    return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been updated.');
}


public function displayCompanyDeduction()
{
    $deduction = Deduction::all();
    return view('pages.admin.settings.deduction', ['deduction' => $deduction]);

}

public function addCompanyDeduction()
{
    return view('pages.admin.settings.add-deduction');
}



public function postAddCompanyDeduction(Request $request, $id)
{    $validatedDeductionData = $request->validate([
   'code' => 'required',
   'name' => 'required',
   'type' => 'required',
   'amount' => 'required',
   'statutory'=> '',
    ]);

    $validatedDeductionCostCentreData = $request->validate([
        'cost_centres'=>'required|numeric',
    ]);

    // dd($validatedData);
    $validatedDeductionData['statutory'] = implode(",", $request->statutory);
    $validatedDeductionData['status'] = 'Active';
    $validatedDeductionData['company_id']=$id;
   // $validatedDeductionCostCentreData['cost_centre']=$request['cost_centre'];

    $deduction = Deduction::create($validatedDeductionData);
    $deduction->cost_centres()->sync($validatedDeductionCostCentreData['cost_centres']);

  //  $user->save();
  return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Deduction has successfully been added.');
}




public function editCompanyDeduction(Request $request, $id) {
    $deduction = Deduction::find($id);

    return view('pages.admin.settings.edit-deduction', ['deduction' => $deduction]);
}

public function postEditCompanyDeduction(Request $request)
{
    $id = $request->id;

    $validateDeductionData = $request->validate([
        'code' => 'required',
        'name' => 'required',
        'type' => 'required',
        'amount' => 'required',
        'statutory'=> '',

        'status'=>'required',
        'ea_form_id' =>'required',

    ]);


    $validateDeductionData['statutory'] = implode(",", $request->statutory);
    $validateDeductionData['confirmed_employee'] = $request->input('confirmed_employee');




     $deduction =Deduction::where('id', $request->company_deduction_id)->update($validateDeductionData);
  //  $addition->cost_centres()->sync($validatedAdditionCostCentreData['cost_centres']);

  return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Deduction Group has successfully been updated.');




}




public function displayCompanyAddition()
{

    $addition = Addition::all();
    return view('pages.admin.settings.addition', ['addition' => $addition]);
}



public function addCompanyAddition()
{
    return view('pages.admin.settings.add-addition');
}


public function postAddCompanyAddition(Request $request, $id)
{

    $validatedAdditionData = $request->validate([
        'code' => 'required',
        'name' => 'required',
        'type' => 'required',
        'amount' => 'required',
        'statutory'=> '',
        'ea_form_id' =>'required'
         ]);

       //  dd($request->confirmed_employee);
         $validatedAdditionCostCentreData = $request->validate([
            'cost_centres'=>'required|numeric',
        ]);
        $validatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
        // dd($validatedData);
        $validatedAdditionData['statutory'] = implode(",", $request->statutory);
        $validatedAdditionData['status'] = 'Active';
        $validatedAdditionData['company_id']=$id;
       // $validatedDeductionCostCentreData['cost_centre']=$request['cost_centre'];

        $addition = Addition::create($validatedAdditionData);
        $addition->cost_centres()->sync($validatedAdditionCostCentreData['cost_centres']);


        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Addition has successfully been added.');
    }

public function editCompanyAddition(Request $request, $id) {
    $addition = Addition::find($id);

    return view('pages.admin.settings.edit-addition', ['addition' => $addition]);
}

public function postEditCompanyAddition(Request $request)
{
    $id = $request->id;

    $validatedAdditionData = $request->validate([
        'code' => 'required',
        'name' => 'required',
        'type' => 'required',
        'amount' => 'required',
        'statutory'=> '',

        'status'=>'required',
        'ea_form_id' =>'required',

    ]);


    $validatedAdditionData['statutory'] = implode(",", $request->statutory);
    $validatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
    // $validatedAdditionCostCentreData = $request->validate([
    //     'cost_centres'=>'required|numeric',
    // ]);

    // dd($validatedData);
   // $validatedAdditionData['company_id']=$id;
   // $validatedDeductionCostCentreData['cost_centre']=$request['cost_centre'];




     $addition =Addition::where('id', $request->company_addition_id)->update($validatedAdditionData);
  //  $addition->cost_centres()->sync($validatedAdditionCostCentreData['cost_centres']);


  return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Addiition Group has successfully been updated.');






}



// public function displayCompanyBank()
// {
//    $companybank = CompanyBank::all();
//     return view('pages.admin.settings.company-bank', ['companybank' => $companybank]);
// }

public function displayCompanyBank($id)
{
    $companybanks = CompanyBank::where('id', $id)->get();
    return view('pages.admin.settings.company-bank', ['companybank' => $companybank]);
}

public function addCompanyBank($id)
{
    return redirect()->route('admin.settings.company-banks.add');

}

public function postAddCompanyBank(Request $request,$id)
{
    $additionData = $request->validate([
        'bank_code' => 'required',
        'acc_name' => 'required'
    ]);

    if ($request->status =='Active'){

    CompanyBank::where('company_id',$id)
    ->where('status','Active')
    ->update(['status'=>'Inactive']);


    $additionData['status'] = 'Active';
    $additionData['company_id']= $id;
    $additionData['created_by'] = auth()->user()->id;
    CompanyBank::create($additionData);
}
else {
    $additionData['status'] = 'Inactive';
    $additionData['company_id']= $id;
    $additionData['created_by'] = auth()->user()->id;
    CompanyBank::create($additionData);
}
    return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Bank has successfully been added.');
}



public function postEditCompanyBank(Request $request)
{

    $id = $request->id;
    $additionData = $request->validate([
        'bank_code' => 'required',
        'acc_name' => 'required',
        'status'  => 'required'
    ]);


    if ($request->status =='Active'){

        CompanyBank::where('company_id',$id)
        ->where('status','Active')
        ->update(['status'=>'Inactive']);


        $additionData['status'] = 'Active';
        $additionData['company_id']= $id;
        $additionData['created_by'] = auth()->user()->id;



    CompanyBank::where('id',  $request->company_bank_id)->update($additionData);

    }

    else {

        $additionData['status'] = 'Inactive';
        $additionData['company_id']= $id;
        $additionData['created_by'] = auth()->user()->id;
        CompanyBank::where('id',  $request->company_bank_id)->update($additionData);
    }
    return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Bank has successfully been updated.');
}


public function deleteCompanyBank(Request $request, $id)
{


    CompanyBank::find($id)->delete();

    return redirect()->route('admin.settings.company.company-details', ['id'=>$id])->with('status', 'Company Bank has successfully been deleted.');
}

public function postEditSecurityGroup(Request $request)
{
    $id = $request->id;
    $additionData = $request->validate([
            'name' => 'required',
            'description' => 'required'

        ]);
        $additionData['company_id']= $id;
        $additionData['created_by'] = auth()->user()->id;


    SecurityGroup::where('id',  $request->security_group_id)->update($additionData);

    return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Security Group has successfully been updated.');
}


public function displaySecurities()
{
    $security = SecurityGroup::all();
    return view('pages.admin.settings.security', ['security' => $security]);

}

public function addCompanySecurities()
{
    return view('pages.admin.settings.add-securities');
}

public function postAddCompanySecurityGroup(Request $request,$id)
{

    $validateSecurityGroup = $request->validate([
        'description' => 'required',
        'security_name' => 'required|unique:security_groups,name,NULL,id,deleted_at,NULL',
    ]);

    $validateSecurityGroup['company_id']=$id;
    $validateSecurityGroup['created_by'] = auth()->user()->id;
    SecurityGroup::create($validateSecurityGroup);

  return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Security Group has successfully been added.');
}

public function editCompanySecurities(Request $request, $id) {
    $deduction = Deduction::find($id);

    return view('pages.admin.settings.edit-deduction', ['deduction' => $deduction]);
}

// public function postEditCompanySecurities(Request $request, $id)
// {

//     $deductionData = $request->validate([

//         'id_company_master' => 'required',
//         'code' => 'required',
//         'name' => 'required',
//         'type' => 'required',
//         'amount' => 'required',


//     ]);

//     Deduction::where('id', 1)->update($deductionData);

//     return redirect()->route('admin.settings.company.company-details',['id'=>$id]);
// }



public function displayTravelAllowance()



{

       $employee = Employee::with('user', 'employee_jobs')->find($id);
 //fb   $travel = TravelAllowance::all();
    return view('pages.admin.settings.travel', ['travel' => $travel]);

}

public function addCompanyTravelAllowance()
{
    return view('pages.admin.settings.add-travel-allowance');
}

public function postAddCompanyTravelAllowance(Request $request,$id)
{

   $validateSecurityGroup = $request->validate([

   'rate' => 'required',
   'countries_id'=>'required',
   'code'=>'required',

    ]);

    $validateSecurityGroup['status'] = 'Active';
    $validateSecurityGroup['company_id']=$id;
    // $validateSecurityGroup['created_by'] = auth()->user()->id;
    // $security = SecurityGroup::create($validateSecurityGroup);

    $validateSecurityGroup['created_by'] = auth()->user()->id;
    CompanyTravelAllowance::create($validateSecurityGroup);



  //  $user->save();

  return redirect()->route('admin.settings.company.company-details',['id'=>$id]);
}

// public function editCompanyTravelAllowance(Request $request, $id) {
//     $deduction = Deduction::find($id);

//     return view('pages.admin.settings.edit-deduction', ['deduction' => $deduction]);
// }




public function postEditTravelAllowance(Request $request)
{

    $id =$request->travel_allowance_id;

     $additionData = $request->validate([
            'code' => 'required',
            'rate' => 'required',
            'countries_id'=>'required',

        ]);

     //   $additionData['status'] = 'active';
        $additionData['created_by'] = auth()->user()->id;

    CompanyTravelAllowance::where('id',  $request->travel_id)->update($additionData);


    return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Travel Allowance has successfully been updated.');

}


public function destroyCompanyBank($id)
{
    CompanyBank::find($id)->delete();
    return redirect()->route('admin.settings.companies');
}

// public function postEditSecurityGroup(Request $request, $id)
// {      $additionData = $request->validate([
//             'code' => 'required',
//             'rate' => 'required',


//         ]);

//      //   $additionData['status'] = 'active';
//         $additionData['created_by'] = auth()->user()->id;

//     CompanyTravelAllowance::where('id',  $request->travel_id)->update($additionData);

//     return redirect()->route('admin.settings.companies');
// }


//data table


// public function getDataTableCompanyBank($id)
// {
//     $companyBank = CompanyBank::where('company_id', $id)->get();

//     return DataTables::of($companyBank)->make(true);
// }


    public function importPcb($fileName, $noOfCategory)
    {
        $collection = (new PcbImport)->toCollection($fileName);//,'pcb\p02.xlsx');
//         dd(($collection));
        $pcbs = array();
        $rowCount = 0;
        
        if($noOfCategory == 2){
            $maxCell = 22;
        } else {
            $maxCell = 25;
        }
        
        foreach($collection[0] as $row){
            if($rowCount < 11){
                $rowCount++;
                continue;
            }
            
            if($row[2] != null && is_numeric($row[2])) {
                $cellCount = 3;
                $salary = $row[2];
                if($noOfCategory == 2){
                    $totalChildren = 11;
                } else {
                    $totalChildren = 0;
                }
                
                for($i=$cellCount; $i<=$maxCell; $i++){
                    $amount = $row[$cellCount];
                    
                    if($amount != null && $amount != '-' && is_numeric($amount)){
                        if($noOfCategory == 2){
                            if($cellCount >= 3 && $cellCount <= 12){
                                $category = 2;
                            } else if($cellCount > 12 && $cellCount <= 22){
                                $category = 3;
                            }
                        }else {
                            if($cellCount == 3){
                                $category = 1;
                            } else if($cellCount > 3 && $cellCount <= 14){
                                $category = 2;
                            } else if($cellCount > 14 && $cellCount <= 25){
                                $category = 3;
                            }
                        }
                        
                        $pcbs[] = [
                            'category' => $category,
                            'total_children' => $totalChildren,
                            'salary' => $salary,
                            'amount' => $amount
                        ];
                        
                        if( ($noOfCategory == 3 && $cellCount > 3) || $noOfCategory == 2){
                            $totalChildren++;
                        }
                    }
                    
                    if($noOfCategory == 3 && $totalChildren > 10){
                        $totalChildren = 0;
                    } else if($noOfCategory == 2 && $totalChildren > 20){
                        $totalChildren = 11;
                    }
                    
                    $cellCount++;
                }
            }
            
            $rowCount++;
        }
//         dd($pcbs);
        if(count($pcbs) > 0){
            foreach (array_chunk($pcbs,500) as $p) {
                Pcb::insert($p);
            }
        }
        
        return "Total ".count($pcbs)." records";
    }

}
