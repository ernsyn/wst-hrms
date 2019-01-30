<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Addition;
use App\Branch;
use App\Company;
use App\Country;
use App\CompanyBank;
use App\CostCentre;
use App\Department;
use App\Deduction;
use App\EaForm;
use App\EPF;
use App\Eis;
use App\Employee;
use App\EmployeeInfo;
use App\LeaveRequest;
use App\LeaveType;
use App\Pcb;
use App\Socso;
use App\SecurityGroup;
use App\Team;
use App\User;
use App\EmployeeGrade;
use App\EmployeeWorkingDay;

use DB;
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
    public function displayCompanies()
    {
        $companies = Company::all();
        return view('pages.admin.settings.company', ['companies' => $companies]);
    }
    public function displayCompanyDetails(Request $request)
    {
        $id = $request->id;
        $bank = CompanyBank::where('company_id', $id)->get();
        $company=Company::where('id', $id)->get();
        $security = SecurityGroup::where('company_id', $id)->get();
        $addition = Addition::where('company_id', $id)->get();
        $deduction = Deduction::where('company_id', $id)->get();

        $ea_form = EaForm::all();
        $cost_centre = CostCentre::all();
        $grade = EmployeeGrade::all();

        return view('pages.admin.settings.company.company-details', ['bank'=>$bank, 'grade'=>$grade,
        'security'=>$security, 'addition'=>$addition,'deduction'=>$deduction, 'ea_form'=>$ea_form, 'cost_centre'=>$cost_centre,'company'=>$company]);
    }
    public function displayCostCentres()
    {
        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', ['costs'=>$costs]);
    }
    public function displayDepartments()
    {
        $departments = Department::all();
        return view('pages.admin.settings.department', ['departments'=>$departments]);
    }
    public function displayBranches()
    {
        $branches = Branch::all();
        return view('pages.admin.settings.branch', ['branches'=>$branches]);
    }
    public function displayTeams()
    {
        $teams = Team::all();
        return view('pages.admin.settings.team', ['teams'=>$teams]);
    }
    public function displayPositions()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', ['positions'=>$positions]);
    }
    public function displayGrades()
    {
        $grades = EmployeeGrade::all();
        return view('pages.admin.settings.grade', ['grades'=>$grades]);
    }
    public function displayWorkingDays()
    {
        $working_days = EmployeeWorkingDay::templates()->get();
        return view('pages.admin.settings.working-day', ['working_days'=>$working_days]);
    }
    public function displayEpf()
    {
        $epfs = EPF::all();
        return view('pages.admin.settings.epf', ['epfs' => $epfs]);
    }
    public function displayEis()
    {
        $eiss = Eis::all();
        return view('pages.admin.settings.eis', ['eiss' => $eiss]);
    }
    public function displaySocso()
    {
        $socsos = Socso::all();
        return view('pages.admin.settings.socso', ['socsos' => $socsos]);
    }
    public function displayPcb()
    {
        $pcbs = Pcb::all();
        return view('pages.admin.settings.pcb', ['pcbs' => $pcbs]);
    }


    // SECTION: Add
    public function addCompany()
    {
        return view('pages.admin.settings.add-company');
    }
    public function addCostCentre()
    {
        return view('pages.admin.settings.add-cost-centre');
    }
    public function addDepartment()
    {
        return view('pages.admin.settings.add-department');
    }
    public function addBranch()
    {
        return view('pages.admin.settings.add-branch');
    }
    public function addTeam()
    {
        return view('pages.admin.settings.add-team');
    }
    public function addPosition()
    {
        return view('pages.admin.settings.add-position');
    }
    public function addGrade()
    {
        return view('pages.admin.settings.add-grade');
    }
    public function addWorkingDay()
    {
        return view('pages.admin.settings.add-working-day');
    }
    public function addEpf()
    {
        return view('pages.admin.settings.add-epf');
    }
    public function addEis()
    {
        return view('pages.admin.settings.add-eis');
    }
    public function addSocso()
    {
        return view('pages.admin.settings.add-socso');
    }
    public function addPcb()
    {
        return view('pages.admin.settings.add-pcb');
    }


    // SECTION: POST ADD
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
        ],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        $companyData['status'] = 'Active';
        Company::create($companyData);
        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been added.');
    }
    public function postAddCostCentre(Request $request)
    {
        $costCentreData = $request->validate([
            'name' => 'required|unique:cost_centres,name,NULL,id,deleted_at,NULL',
            'seniority_pay' =>'required'

        ]);

        $costCentreData['amount'] = '50.00';
        $costCentreData['created_by'] = auth()->user()->name;

        CostCentre::create($costCentreData);
        return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been added.');
    }
    public function postAddDepartment(Request $request)
    {
        $departmentData = $request->validate([
            'name' => 'required|unique:departments,name,NULL,id,deleted_at,NULL'

        ]);

        Department::create($departmentData);
        return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been added.');
    }
    public function postAddPosition(Request $request)
    {
        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions,name,NULL,id,deleted_at,NULL',

        ]);
        
        $positionData['created_by'] = auth()->user()->name;
        EmployeePosition::create($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been added.');
    }
    public function postAddGrade(Request $request)
    {
        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades,name,NULL,id,deleted_at,NULL',

        ]);
        
        $gradeData['created_by'] = auth()->user()->name;
        EmployeeGrade::create($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been added.');
    }
    public function postAddTeam(Request $request)
    {
        $teamData = $request->validate([
            'name' => 'required|unique:teams,name,NULL,id,deleted_at,NULL',
        ]);

        Team::create($teamData);

        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been added.');
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
        $workingDaysData['created_by'] = auth()->user()->name;
        
        EmployeeWorkingDay::create($workingDaysData);
        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been added.');
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
        $created_by = auth()->user()->name;

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
    public function postAddEpf(Request $request)
    {
        $epfData = $request->validate([
            'category' => 'required|unique:epfs,category',
            'salary' => 'required|numeric',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric',
            'name'=>'required',
    
        ]);

        $epfData['created_by']= auth()->user()->name;
        
    
        EPF::create($epfData);
    
        return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been added.');
    }

    public function postAddEis(Request $request)
    {
        $eisData = $request->validate([
            'salary' =>  'required|unique:eis,salary,NULL,id,deleted_at,NULL',
            'employer' => 'required',
            'employee' => 'required',
        ]);
    
        Eis::create($eisData);
    
        return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been added.');
    }
    public function postAddSocso(Request $request)
    {
        $socsoData = $request->validate([
    
            'salary' => 'required|unique:socsos,salary,NULL,id,deleted_at,NULL',
            'first_category_employer' => 'required',
            'first_category_employee' => 'required',
    
    
        ]);
    
        Socso::create($socsoData);
    
        return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been added.');
    }
    public function postAddCompanyDeduction(Request $request, $id)
    {
        $validatedDeductionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory'=> 'nullable',
            'status'=>'required',
            'ea_form_id' =>'required',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        if(!empty($validatedDeductionData['statutory'])) 
        $validatedDeductionData['statutory'] = implode(",", $request->statutory);
        else 
        $validatedDeductionData['statutory'] = null;

        $validatedDeductionData['confirmed_employee'] = $request->input('confirmed_employee');

        if(!empty($validatedDeductionData['cost_centre'])) 
        $validatedDeductionData['cost_centre'] = implode(",", $request->cost_centre);
        else
         $validatedDeductionData['cost_centre'] = null;

        if(!empty($validatedDeductionData['employee_grade'])) 
        $validatedDeductionData['employee_grade'] = implode(",", $request->employee_grade);
        else 
        $validatedDeductionData['employee_grade'] = null;

        $validatedDeductionData['company_id']=$id;
        $validatedDeductionData['created_by'] = auth()->user()->name;
        // dd($validatedAdditionData['employee_grade']);
        $deduction = Deduction::create($validatedDeductionData);
        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Deduction has successfully been added.');
    } 
    public function postAddCompanyAddition(Request $request, $id)
    {
        $validatedAdditionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory'=> 'nullable',
            'status'=>'required',
            'ea_form_id' =>'required',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
            ]);

            $validatedAdditionData['statutory'] = empty($validatedAdditionData['statutory']) ? null : implode(",", $request->statutory);
            $validatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
            $validatedAdditionData['cost_centre'] = empty($validatedAdditionData['cost_centre']) ? null : implode(",", $request->cost_centre);
            $validatedAdditionData['employee_grade'] = empty($validatedAdditionData['employee_grade']) ? null : implode(",", $request->employee_grade);
            $validatedAdditionData['company_id']=$id;

            // dd($validatedAdditionData['employee_grade']);
            $validatedAdditionData['created_by'] = auth()->user()->name;
            $addition = Addition::create($validatedAdditionData);
            return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Addition has successfully been added.');
    }

    public function postAddCompanySecurityGroup(Request $request,$id)
    {
        $securityGroupData = $request->validate([
            'name' => 'required|unique:security_groups,name,NULL,id,deleted_at,NULL',
            'description' => 'required',
        ]);

        $securityGroupData['company_id']=$id;
        $securityGroupData['created_by'] = auth()->user()->name;
        SecurityGroup::create($securityGroupData);

        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Security Group has successfully been added.');
    }

    public function postAddCompanyBank(Request $request,$id)
    {
        $companyBankData = $request->validate([
            'bank_code' => 'required',
            'acc_name' => 'required',

        ]);

        if ($request->status =='Active'){
            CompanyBank::where('company_id',$id)
            ->where('status','Active')
            ->update(['status'=>'Inactive']);
            $companyBankData['status'] = 'Active';
            $companyBankData['company_id']= $id;
            $companyBankData['created_by'] = auth()->user()->name;
            CompanyBank::create($companyBankData);
        }
        else {
            $companyBankData['status'] = 'Inactive';
            $companyBankData['company_id']= $id;
            $companyBankData['created_by'] = auth()->user()->name;
            CompanyBank::create($companyBankData);
        }
        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Bank has successfully been added.');
    }
    //SECTION: EDIT
    public function editCompany(Request $request, $id) 
    {
        $company = Company::find($id);
        return view('pages.admin.settings.edit-company', ['company' => $company]);
    }
    public function editBranch(Request $request, $id) 
    {
       
        $branch = Branch::find($id);

        return view('pages.admin.settings.edit-branch', ['branch' => $branch]);
    }
    public function editCostCentre(Request $request, $id)
    {
        $costs = CostCentre::find($id);

        return view('pages.admin.settings.edit-cost-centre', ['costs' => $costs]);
    }
    public function editPosition(Request $request, $id) 
    {
       
        $position = EmployeePosition::find($id);

        return view('pages.admin.settings.edit-position', ['position' => $position]);
    }
    public function editGrade(Request $request, $id) 
    {
        
        $grade = EmployeeGrade::find($id);

        return view('pages.admin.settings.edit-grade', ['grade' => $grade]);
    }
    public function editTeam(Request $request, $id) 
    {

        $team = Team::find($id);

        return view('pages.admin.settings.edit-team', ['team' => $team]);
    }
    public function editDepartment(Request $request, $id) 
    {
       
        $department = Department::find($id);

        return view('pages.admin.settings.edit-department', ['department' => $department]);
    }




    public function editWorkingDay(Request $request, $id) 
    {
        $working_day = EmployeeWorkingDay::templates()->find($id);

        return view('pages.admin.settings.edit-working-day', ['working_day' => $working_day]);
    }
    public function editSocso(Request $request, $id) 
    {
        $socso = Socso::find($id);
    
        return view('pages.admin.settings.edit-socso', ['socso' => $socso]);
    }
    public function editEpf(Request $request, $id) 
    {
        $epf = EPF::find($id);
    
        return view('pages.admin.settings.edit-epf', ['epf' => $epf]);
    }
    public function editEis(Request $request, $id) 
    {
        $eis = Eis::find($id);
    
        return view('pages.admin.settings.edit-eis', ['eis' => $eis]);
    }
    public function editPcb(Request $request, $id) 
    {
        $pcbs = Pcb::find($id);
    
        return view('pages.admin.settings.edit-pcb', ['pcbs' => $pcbs]);
    }

    public function editCompanyDeduction(Request $request, $id) 
    {
        $deduction = Deduction::find($id);
        return view('pages.admin.settings.edit-deduction', ['deduction' => $deduction]);
    }
    public function editCompanySecurities(Request $request, $id) 
    {
        $deduction = Deduction::find($id);

        return view('pages.admin.settings.edit-deduction', ['deduction' => $deduction]);
    }
    public function editCompanyAddition(Request $request, $id) 
    {
        $addition = Addition::find($id);
        return view('pages.admin.settings.edit-addition', ['addition' => $addition]);
    }

    //SECTION: POST EDIT
    public function postEditPosition(Request $request, $id)
    {
        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions,name,'.$id.',id,deleted_at,NULL',
        ]);

        EmployeePosition::find($id)->update($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been updated.');
    }
    public function postEditGrade(Request $request, $id)
    {

        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades,name,'.$id.',id,deleted_at,NULL',

        ]);

        EmployeeGrade::find($id)->update($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been updated.');
    }
    public function postEditTeam(Request $request, $id)
    {
        $teamData = $request->validate([
            'name' => 'required|unique:teams,name,'.$id.',id,deleted_at,NULL',
        ]);

        Team::where('id', $id)->update($teamData);
        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been updated.');
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
    public function postEditDepartment(Request $request,$id)
    {

        $departmentData = $request->validate([
            'name' => 'required|unique:departments,name,'.$id.',id,deleted_at,NULL'
        ]);

        Department::find($id)->update($departmentData);

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

        EmployeeWorkingDay::templates()->find($id)->update($workingDayData);

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

            Branch::find($id)->update($branchData);

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
        ],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        Company::find($id)->update($companyData);

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been updated.');
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
    public function postEditEis(Request $request, $id)
    {
    
        $eisData = $request->validate([
    
            'salary' => 'required|unique:eis,salary,'.$id.',id,deleted_at,NULL',
            'employer' => 'required',
            'employee' => 'required',
    
        ]);
    
        Eis::where('id', $id)->update($eisData);
    
        return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been updated.');
    }

    public function postEditSocso(Request $request, $id)
    {
    
        $socsoData = $request->validate([
    
            'salary' => 'required|unique:socsos,salary,'.$id.',id,deleted_at,NULL',
            'first_category_employer' => 'required',
            'first_category_employee' => 'required',
    
        ]);
    
        Socso::where('id', $id)->update($socsoData);
    
        return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been updated.');
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
    public function postEditCompanyDeduction(Request $request)
    {
        $id = $request->id;
        $updateValidatedDeductionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory'=> 'nullable',
            'status'=>'required',
            'ea_form_id' =>'required',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        if(!empty($updateValidatedDeductionData['statutory'])) 
        $updateValidatedDeductionData['statutory'] = implode(",", $request->statutory);
        else 
        $updateValidatedDeductionData['statutory'] = null;

        $updateValidatedDeductionData['confirmed_employee'] = $request->input('confirmed_employee');

        if(!empty($updateValidatedDeductionData['cost_centre'])) 
        $updateValidatedDeductionData['cost_centre'] = implode(",", $request->cost_centre);
        else 
        $updateValidatedDeductionData['cost_centre'] = null;

        if(!empty($updateValidatedDeductionData['employee_grade'])) 
        $updateValidatedDeductionData['employee_grade'] = implode(",", $request->employee_grade);
        else 
        $updateValidatedDeductionData['employee_grade'] = null;

        $updateValidatedDeductionData['company_id']=$id;

        Deduction::where('id', $request->company_deduction_id)->update($updateValidatedDeductionData);
        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Deduction Group has successfully been updated.');
    }

    public function postEditCompanyBank(Request $request)
    {

        $id = $request->id;
        $updateCompanyBankData = $request->validate([
            'bank_code' => 'required',
            'acc_name' => 'required',
            'status'  => 'required'
        ]);

        $updateCompanyBankData['company_id']= $id;
        $updateCompanyBankData['updated_by'] = auth()->user()->name;
        CompanyBank::where('id',  $request->company_bank_id)->update($updateCompanyBankData);

        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Company Bank has successfully been updated.');
    }
    public function postEditCompanyAddition(Request $request)
    {
        $id = $request->id;
        $updateValidatedAdditionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory'=> 'nullable',
            'status'=>'required',
            'ea_form_id' =>'required',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        $updateValidatedAdditionData['statutory'] = empty($updateValidatedAdditionData['statutory']) ? null : implode(",", $request->statutory);
        $updateValidatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
        $updateValidatedAdditionData['cost_centre'] = empty($updateValidatedAdditionData['cost_centre']) ? null : implode(",", $request->cost_centre);
        $updateValidatedAdditionData['employee_grade'] = empty($updateValidatedAdditionData['employee_grade']) ? null : implode(",", $request->employee_grade);
        $updateValidatedAdditionData['company_id']=$id;

        Addition::find($request->company_addition_id)->update($updateValidatedAdditionData);
        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Addition Group has successfully been updated.');
    }
    public function postEditSecurityGroup(Request $request)
    {
        $id = $request->id;
        $updateSecurityGroupData = $request->validate([
                'name' => 'required',
                'description' => 'required'

            ]);
            $updateSecurityGroupData['company_id']= $id;
            $updateSecurityGroupData['created_by'] = auth()->user()->name;


        SecurityGroup::where('id',  $request->security_group_id)->update($updateSecurityGroupData);

        return redirect()->route('admin.settings.company.company-details',['id'=>$id])->with('status', 'Security Group has successfully been updated.');
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
    





}
