<?php
namespace App\Http\Controllers\Admin;

use App\Constants\PermissionConstant;
use App\Enums\EisCategoryEnum;
use App\Enums\EpfCategoryEnum;
use App\Enums\SocsoCategoryEnum;
use App\Helpers\GenerateReportsHelper;
use App\Helpers\PayrollHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addition;
use App\Area;
use App\EmployeeGrade;
use App\EmployeeJob;
use App\EmployeeWorkingDay;
use App\Branch;
use App\Company;
use App\CompanyBank;
use App\CostCentre;
use App\Department;
use App\Deduction;
use App\EPF;
use App\Eis;
use App\Employee;
use App\EmployeePosition;
use App\Pcb;
use App\Socso;
use App\SecurityGroup;
use App\Team;
use App\Imports\PcbImport;

use DB;
use Crypt;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use DateTime;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\AccessControllHelper;
use App\JobCompany;
use App\Section;
use App\Category;
use App\EmploymentStatus;
use App\CompanyAsset;
use App\BankCode;
use App\DepartmentHod;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // SECTION: Display
    public function displayCompanies()
    {
        $companies = Company::all();
        return view('pages.admin.settings.company', [
            'companies' => $companies
        ]);
    }

    public function displayCompanyDetails(Request $request)
    {
        $id = $request->id;
        $bank = CompanyBank::where('company_id', $id)->get();
        $company = Company::where('id', $id)->first();
        $jobCompny = JobCompany::where('company_id', $id)->get();
//         $security = SecurityGroup::where('company_id', $id)->get();
//         $addition = Addition::where('company_id', $id)->get();
//         $deduction = Deduction::where('company_id', $id)->get();

//         $ea_form = EaForm::all();
//         $cost_centre = CostCentre::all();
//         $grade = EmployeeGrade::all();

        return view('pages.admin.settings.company.company-details', [
            'bank' => $bank,
//             'grade' => $grade,
//             'security' => $security,
//             'addition' => $addition,
//             'deduction' => $deduction,
//             'ea_form' => $ea_form,
//             'cost_centre' => $cost_centre,
            'company' => $company,
            'jobCompany' => $jobCompny,
        ]);
    }
    
    public function displaySecurityGroups()
    {
        $securityGroups = SecurityGroup::all();
        return view('pages.admin.settings.security-group', [
            'securityGroups' => $securityGroups
        ]);
    }

    public function displayCostCentres()
    {
        $costs = CostCentre::all();
        return view('pages.admin.settings.cost-centre', [
            'costs' => $costs
        ]);
    }

    public function displayDepartments()
    {
        $departments = Department::all();
        $departments->load('hod');
        return view('pages.admin.settings.department', [
            'departments' => $departments
        ]);
    }

    public function displayBranches()
    {
        $branches = Branch::all()->load('area');
        return view('pages.admin.settings.branch', [
            'branches' => $branches
        ]);
    }

    public function displayTeams()
    {
        $teams = Team::all();
        return view('pages.admin.settings.team', [
            'teams' => $teams
        ]);
    }

    public function displayPositions()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.settings.position', [
            'positions' => $positions
        ]);
    }

    public function displayGrades()
    {
        $grades = EmployeeGrade::all();
        return view('pages.admin.settings.grade', [
            'grades' => $grades
        ]);
    }
    
    public function displaySections()
    {
        $sections = Section::all();
        return view('pages.admin.settings.section', [
            'sections' => $sections
        ]);
    }
    
    public function displayAreas()
    {
        $areas = Area::all();
        return view('pages.admin.settings.area', [
            'areas' => $areas
        ]);
    }
    
    public function displayBankCode()
    {
        $bankCodes = BankCode::all();
        return view('pages.admin.settings.bank-code', [
            'bankCodes' => $bankCodes
        ]);
    }
    
    public function displayCategories()
    {
        $categories = Category::all();
        return view('pages.admin.settings.category', [
            'categories' => $categories
        ]);
    }
    
    public function displayEmploymentStatus()
    {
        $employmentStatus = EmploymentStatus::all();
        return view('pages.admin.settings.employment-status', [
            'employmentStatus' => $employmentStatus
        ]);
    }
    
    public function displayCompanyAsset()
    {
        $companyAssets = CompanyAsset::all();
        return view('pages.admin.settings.company-asset', [
            'companyAssets' => $companyAssets
        ]);
    }

    public function displayWorkingDays()
    {
        $working_days = EmployeeWorkingDay::templates()->get();
        return view('pages.admin.settings.working-day', [
            'working_days' => $working_days
        ]);
    }

    public function displayEpf()
    {
        $epfs = EPF::all();
        return view('pages.admin.settings.epf', [
            'epfs' => $epfs
        ]);
    }

    public function displayEis()
    {
        $eiss = Eis::all();
        return view('pages.admin.settings.eis', [
            'eiss' => $eiss
        ]);
    }

    public function displaySocso()
    {
        $socsos = Socso::all();
        return view('pages.admin.settings.socso', [
            'socsos' => $socsos
        ]);
    }

    public function displayPcb()
    {
        return view('pages.admin.settings.pcb');
    }

    public function getPcbData(Request $request)
    {
//         Log::debug($request);
        $user = Auth::user();
//         $pcbs = Pcb::query(); // Pcb::select(['id', 'category', 'salary', 'total_children', 'amount'])->get();
        $filterDropdown = array();
        $filterInput = array();
        if($request->category != null){
            $filterDropdown['category']  = $request->category;
        }
        if($request->salary != null){
            $filterInput['salary']  = $request->salary;
        }
        if($request->numberOfChildren != null){
            $filterDropdown['total_children']  = $request->numberOfChildren;
        }
        if($request->amount != null){
            $filterInput['amount']  = $request->amount;
        }
        
        $pcbs = DB::table('pcbs');
        
        if(count($filterDropdown) > 0){
            foreach($filterDropdown as $key => $value){
                $pcbs->where($key, $value);
            }
        }
        
        if(count($filterInput) > 0){
            foreach($filterInput as $key => $value){
                $pcbs->where($key, 'like', "{$value}%");
            }
        }
        
        $count = $pcbs->count();

        $column = 'category';
        switch ($request->order[0]['column']) {
            case 1:
                $column = 'category';
                break;
            case 2:
                $column = 'salary';
                break;
            case 3:
                $column = 'total_children';
                break;
            case 4:
                $column = 'amount';
                break;
        }
        
        $dir = 'asc';
        if(isset($request->order[0]['dir'])) {
            $dir = $request->order[0]['dir'];
        }
        
        $pcbs = $pcbs
            ->orderBy($column, $dir)
            ->offset($request->start)
            ->limit($request->length)
            ->get();
        
//         Log::debug($pcbs);
        
        $data = array();
        foreach($pcbs as $pcb) {
            $subdata = array();
            $subdata[] = $pcb->id;
            $subdata[] = $pcb->category;
            $subdata[] = $pcb->salary;
            $subdata[] = $pcb->total_children;
            $subdata[] = $pcb->amount;
            
            $button = '';
            if($user->can(PermissionConstant::UPDATE_PCB) && $user->can(PermissionConstant::DELETE_PCB)) {
                $button = '<button onclick="window.location=\'' . url('/admin/settings/pcb/' . $pcb->id . '/edit') . '\'" class="btn btn-success btn-smt fas fa-edit"></button>
                    <button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title="' . $pcb->category . '" data-link="' . url('/admin/settings/pcb/' . $pcb->id . '/delete') . '" class="btn btn-danger btn-smt fas fa-trash-alt"></button>';
            } else if($user->can(PermissionConstant::UPDATE_PCB)) {
                $button = '<button onclick="window.location=\'' . url('/admin/settings/pcb/' . $pcb->id . '/edit') . '\'" class="btn btn-success btn-smt fas fa-edit"></button>';
            } else if($user->can(PermissionConstant::DELETE_PCB)) {
                $button = '<button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title="' . $pcbs->category . '" data-link="' . url('/admin/settings/pcb/' . $pcbs->id . '/delete') . '" class="btn btn-danger btn-smt fas fa-trash-alt"></button>';
            }
            
            $subdata[] = $button;
            $data[] = $subdata;
        }
        
        return Datatables::of($pcbs)->with([
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data
        ])->make(true);
    }

    // SECTION: Add
    public function addCompany()
    {
        return view('pages.admin.settings.add-company');
    }
    
    public function addSecurityGroup()
    {
        return view('pages.admin.settings.add-security-group');
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
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $areas = Area::where('company_id', $company->id)->get();
        
        return view('pages.admin.settings.add-branch', [
            'areas' => $areas
        ]);
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
    
    public function addSection()
    {
        return view('pages.admin.settings.add-section');
    }
    
    public function addArea()
    {
        return view('pages.admin.settings.add-area');
    }
    
    public function addBankCode()
    {
        return view('pages.admin.settings.add-bank-code');
    }
    
    public function addCategory()
    {
        return view('pages.admin.settings.add-category');
    }
    
    public function addEmploymentStatus()
    {
        return view('pages.admin.settings.add-employment-status');
    }
    
    public function addCompanyAsset()
    {
        return view('pages.admin.settings.add-company-asset');
    }

    public function addWorkingDay()
    {
        return view('pages.admin.settings.add-working-day');
    }

    public function addEpf()
    {
        $category = EpfCategoryEnum::choices();
        return view('pages.admin.settings.add-epf', [
            'category' => $category
        ]);
    }

    public function addEis()
    {
        $category = EisCategoryEnum::choices();
        return view('pages.admin.settings.add-eis', ['category' => $category]);
    }

    public function addSocso()
    {
        $category = SocsoCategoryEnum::choices();
        return view('pages.admin.settings.add-socso', [
            'category' => $category
        ]);
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
            'tax_no' => 'required',
            'epf_no' => 'required',
            'socso_no' => 'required',
            'eis_no' => 'required',
            'code' => 'required|unique:companies,code,NULL,id,deleted_at,NULL',
            
            'postcode' => 'required|numeric'
        ], [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        $companyData['status'] = 'Active';
        Company::create($companyData);
        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been added.');
    }
    
    public function postAddSecurityGroup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $securityGroup = SecurityGroup::where('name','=',$request->name)->where('company_id','=',$company->id)->count();
        
        if ($securityGroup == 0) {
            $securityGroup = new SecurityGroup();
            $securityGroup->name = $request->name;
            $securityGroup->description = $request->description;
            $securityGroup->company_id = $company->id;
            $securityGroup->created_by = auth()->user()->name;
            $securityGroup->save();
            
            return redirect()->route('admin.settings.security-group')->with('status', 'Security Group is added.');
        }
        else
        {
            return redirect()->route('admin.settings.security-group')->with('status', 'Security Group Name already taken.');
        }
    }
    
    public function postAddCostCentre(Request $request)
    {
        $costCentreData = $request->validate([
            'name' => 'required|unique:cost_centres,name,NULL,id,deleted_at,NULL'
        ]);

        $costCentreData['created_by'] = auth()->user()->name;

        CostCentre::create($costCentreData);
        return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been added.');
    }

    public function postAddDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,NULL,id,deleted_at,NULL',
            'hod' => 'required'
        ]);

        DB::beginTransaction();
        $department = new Department();
        $department->name = $request->name;
        $department->save();
        
        foreach($request->hod as $employeeId) {
            $departmentHod = new DepartmentHod();
            $departmentHod->department_id = $department->id;
            $departmentHod->employee_id = $employeeId;
            $departmentHod->save();
        }
        
        DB::commit();
        return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been added.');
    }

    public function postAddPosition(Request $request)
    {
        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions,name,NULL,id,deleted_at,NULL'
        ]);

        $positionData['created_by'] = auth()->user()->name;
        EmployeePosition::create($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been added.');
    }

    public function postAddGrade(Request $request)
    {
        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades,name,NULL,id,deleted_at,NULL'
        ]);

        $gradeData['created_by'] = auth()->user()->name;
        EmployeeGrade::create($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been added.');
    }

    public function postAddSection(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $section = new Section();
        $section->name = $request['name'];
        $section->company_id = $company->id;
        $section->save();
        
        return redirect()->route('admin.settings.sections')->with('status', 'Section is added.');
    }
    
    public function postAddArea(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:areas'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $area = new Area();
        $area->name = $request['name'];
        $area->company_id = $company->id;
        $area->save();
        
        return redirect()->route('admin.settings.areas')->with('status', 'Area is added.');
    }
    
    public function postAddBankCode(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bic_code' => 'required'
        ]);
        
        $bankCode = new BankCode();
        $bankCode->name = $request['name'];
        $bankCode->bic_code = $request['bic_code'];
        $bankCode->status = 'Active';
        $bankCode->save();
        
        return redirect()->route('admin.settings.bank-code')->with('status', 'Bank code is added.');
    }
    
    public function postAddCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $category = new Category();
        $category->name = $request['name'];
        $category->company_id = $company->id;
        $category->save();
        
        return redirect()->route('admin.settings.categories')->with('status', 'Category is added.');
    }
    
    public function postAddEmploymentStatus(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:employment_statuses',
            'name' => 'required'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $employmentStatus = new EmploymentStatus();
        $employmentStatus->code = $request['code'];
        $employmentStatus->name = $request['name'];
        $employmentStatus->company_id = $company->id;
        $employmentStatus->save();
        
        return redirect()->route('admin.settings.employment-status')->with('status', 'Employment Status is added.');
    }
    
    public function postAddCompanyAsset(Request $request)
    {
        $request->validate([
            'item_code' => 'required|unique:company_assets',
            'item_name' => 'required'
        ]);
        
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        $companyAsset = new CompanyAsset();
        $companyAsset->item_code = $request['item_code'];
        $companyAsset->item_name = $request['item_name'];
        $companyAsset->company_id = $company->id;
        $companyAsset->save();
        
        return redirect()->route('admin.settings.company-asset')->with('status', 'Company asset is added.');
    }

    public function postAddTeam(Request $request)
    {
        $teamData = $request->validate([
            'name' => 'required|unique:teams,name,NULL,id,deleted_at,NULL'
        ]);

        Team::create($teamData);

        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been added.');
    }
    
    public function postAddPcb(Request $request)
    {
        $pcbData = $request->validate([
            'category' => 'required',//|unique:pcbs,category,NULL,id,deleted_at,NULL',
            'salary' => 'required|numeric',
            'amount' => 'required|numeric',
            'total_children' => 'required|numeric'
        ]);

//         Pcb::save($pcbData);
        
        $pcb = Pcb::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ],
            [
                'total_children',
                $request['total_children']
            ]
        ])->whereNull('deleted_at')->get();
        
        if ($pcb->isEmpty()) {
            $pcb = new Pcb($pcbData);
            $pcb->save();
            return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been added.');
        } else {
            return redirect()->route('admin.settings.pcb')->with('status', 'Data already exists.');
        }
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
            'sunday' => 'required'
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
        ?,?,?)', [
            $user->id,
            $branch,
            'auto',
            $position,
            $department,
            $team,
            $cost_centre,
            $grade,
            $start_date,
            $basic_salary,
            $emp_status,
            $created_by
        ]);

        return redirect()->route('admin/profile-employee/{id}', [
            'id' => $user_id
        ]);
    }

    public function postAddBranch(Request $request)
    {
        $branchData = $request->validate([
            'name' => 'required|unique:branches,name,NULL,id,deleted_at,NULL',
            'contact_no_primary' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'contact_no_secondary' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'fax_no' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'country_code' => 'nullable|integer',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required|numeric|digits:5',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area_id' => 'required',
            'state_holiday' => 'required'
        ], [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);
//         dd($branchData);
        Branch::create($branchData);
        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been added.');
    }

    public function postAddEpf(Request $request)
    {
        $epfData = $request->validate([
            'category' => 'required', // 'required|unique:epfs,category',
            'salary' => 'required|numeric',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $epf = EPF::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ]
        ])->whereNull('deleted_at')->get();

        if ($epf->isEmpty()) {
            $epfData['created_by'] = auth()->user()->name;
            $epf = new EPF($epfData);
            $epf->save();
            return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been added.');
        } else {
            return redirect()->route('admin.settings.epf')->with('status', 'Data already exists.');
        }
    }

    public function postAddEis(Request $request)
    {
        $eisData = $request->validate([
            'category' => 'required',
            'salary' => 'required|numeric', // 'required|unique:eis,salary,NULL,id,deleted_at,NULL',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $eis = Eis::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ]
        ])->whereNull('deleted_at')->get();

        if ($eis->isEmpty()) {
            $eis = new EIS($eisData);
            $eis->save();
            return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been added.');
        } else {
            return redirect()->route('admin.settings.eis')->with('status', 'Data already exists.');
        }
    }

    public function postAddSocso(Request $request)
    {
        $socsoData = $request->validate([
            'category' => 'required',
            'salary' => 'required', // 'required|unique:socsos,salary,NULL,id,deleted_at,NULL',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $socso = Socso::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ]
        ])->whereNull('deleted_at')->get();

        if ($socso->isEmpty()) {
            $socso = new SOCSO($socsoData);
            $socso->save();
            return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been added.');
        } else {
            return redirect()->route('admin.settings.socso')->with('status', 'Data already exists.');
        }
    }

    public function postAddCompanyDeduction(Request $request, $id)
    {
        $validatedDeductionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory' => 'nullable',
            'status' => 'required',
            'ea_form_id' => 'nullable',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        if (! empty($validatedDeductionData['statutory']))
            $validatedDeductionData['statutory'] = implode(",", $request->statutory);
        else
            $validatedDeductionData['statutory'] = null;

        $validatedDeductionData['confirmed_employee'] = $request->input('confirmed_employee');

        if (! empty($validatedDeductionData['cost_centre']))
            $validatedDeductionData['cost_centre'] = implode(",", $request->cost_centre);
        else
            $validatedDeductionData['cost_centre'] = null;

        if (! empty($validatedDeductionData['employee_grade']))
            $validatedDeductionData['employee_grade'] = implode(",", $request->employee_grade);
        else
            $validatedDeductionData['employee_grade'] = null;

        $validatedDeductionData['company_id'] = $id;
        $validatedDeductionData['created_by'] = auth()->user()->name;
        $deduction = Deduction::create($validatedDeductionData);
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Company Deduction has successfully been added.');
    }

    public function postAddCompanyAddition(Request $request, $id)
    {
        $validatedAdditionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory' => 'nullable',
            'status' => 'required',
            'ea_form_id' => 'nullable',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        $validatedAdditionData['statutory'] = empty($validatedAdditionData['statutory']) ? null : implode(",", $request->statutory);
        $validatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
        $validatedAdditionData['cost_centre'] = empty($validatedAdditionData['cost_centre']) ? null : implode(",", $request->cost_centre);
        $validatedAdditionData['employee_grade'] = empty($validatedAdditionData['employee_grade']) ? null : implode(",", $request->employee_grade);
        $validatedAdditionData['company_id'] = $id;
        $validatedAdditionData['created_by'] = auth()->user()->name;
        $addition = Addition::create($validatedAdditionData);
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Company Addition has successfully been added.');
    }

    public function postAddCompanyBank(Request $request, $id)
    {
        $companyBankData = $request->validate([
            'bank_code' => 'required',
            'acc_name' => 'required'
        ]);

        if ($request->status == 'Active') {
            CompanyBank::where('company_id', $id)->where('status', 'Active')->update([
                'status' => 'Inactive'
            ]);
            $companyBankData['status'] = 'Active';
            $companyBankData['company_id'] = $id;
            $companyBankData['created_by'] = auth()->user()->name;
            CompanyBank::create($companyBankData);
        } else {
            $companyBankData['status'] = 'Inactive';
            $companyBankData['company_id'] = $id;
            $companyBankData['created_by'] = auth()->user()->name;
            CompanyBank::create($companyBankData);
        }
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Company Bank has successfully been added.');
    }
    
    public function postAddJobCompany(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required'
        ]);
        
        $jobCompany = JobCompany::where('company_name','=',$request->company_name)
            ->where('company_id','=',$id)->count();
        
        if ($jobCompany == 0) {
            $jobCompany = new JobCompany();
            $jobCompany->company_name = $request['company_name'];
            $jobCompany->company_id = $id;
            $jobCompany->save();
            
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $id
            ])->with('status', 'Job Company is added.');
        } else {
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $id
            ])->with('status', 'The Company Name has already been taken.');
        }
    }

    // SECTION: EDIT
    public function editCompany(Request $request, $id)
    {
        $company = Company::find($id);
        return view('pages.admin.settings.edit-company', [
            'company' => $company
        ]);
    }
    
    public function editSecurityGroup(Request $request, $id)
    {
        $securityGroup = SecurityGroup::find($id);
        
        return view('pages.admin.settings.edit-security-group', [
            'securityGroup' => $securityGroup
        ]);
    }

    public function editBranch(Request $request, $id)
    {
        $branch = Branch::find($id);
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $areas = Area::where('company_id', $company->id)->get();

        return view('pages.admin.settings.edit-branch', [
            'branch' => $branch,
            'areas' => $areas
        ]);
    }

    public function editCostCentre(Request $request, $id)
    {
        $costs = CostCentre::find($id);

        return view('pages.admin.settings.edit-cost-centre', [
            'costs' => $costs
        ]);
    }

    public function editPosition(Request $request, $id)
    {
        $position = EmployeePosition::find($id);

        return view('pages.admin.settings.edit-position', [
            'position' => $position
        ]);
    }

    public function editGrade(Request $request, $id)
    {
        $grade = EmployeeGrade::find($id);

        return view('pages.admin.settings.edit-grade', [
            'grade' => $grade
        ]);
    }
    
    public function editSection(Request $request, $id)
    {
        $section = Section::find($id);
        
        return view('pages.admin.settings.edit-section', [
            'section' => $section
        ]);
    }
    
    public function editArea(Request $request, $id)
    {
        $area = Area::find($id);
        
        return view('pages.admin.settings.edit-area', [
            'area' => $area
        ]);
    }
    
    public function editBankCode(Request $request, $id)
    {
        $bankCode = BankCode::find($id);
        
        return view('pages.admin.settings.edit-bank-code', [
            'bankCode' => $bankCode
        ]);
    }
    
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        
        return view('pages.admin.settings.edit-category', [
            'category' => $category
        ]);
    }
    
    public function editEmploymentStatus(Request $request, $id)
    {
        $employmentStatus = EmploymentStatus::find($id);
        
        return view('pages.admin.settings.edit-employment-status', [
            'employmentStatus' => $employmentStatus
        ]);
    }
    
    public function editCompanyAsset(Request $request, $id)
    {
        $companyAsset = CompanyAsset::find($id);
        
        return view('pages.admin.settings.edit-company-asset', [
            'companyAsset' => $companyAsset
        ]);
    }

    public function editTeam(Request $request, $id)
    {
        $team = Team::find($id);

        return view('pages.admin.settings.edit-team', [
            'team' => $team
        ]);
    }

    public function editDepartment(Request $request, $id)
    {
        $department = Department::find($id);
        $hods = array();
        
        foreach($department->hod as $dh) {
            array_push($hods, $dh->employee());
        }

        return view('pages.admin.settings.edit-department', [
            'department' => $department,
            'hods' => $hods
        ]);
    }

    public function editWorkingDay(Request $request, $id)
    {
        $working_day = EmployeeWorkingDay::templates()->find($id);

        return view('pages.admin.settings.edit-working-day', [
            'working_day' => $working_day
        ]);
    }

    public function editSocso(Request $request, $id)
    {
        $socso = Socso::find($id);
        $category = SocsoCategoryEnum::choices();

        return view('pages.admin.settings.edit-socso', [
            'socso' => $socso,
            'category' => $category
        ]);
    }

    public function editEpf(Request $request, $id)
    {
        $epf = EPF::find($id);
        $category = EpfCategoryEnum::choices();

        return view('pages.admin.settings.edit-epf', [
            'epf' => $epf,
            'category' => $category
        ]);
    }

    public function editEis(Request $request, $id)
    {
        $eis = Eis::find($id);
        $category = EisCategoryEnum::choices();

        return view('pages.admin.settings.edit-eis', [
            'eis' => $eis,
            'category' => $category
        ]);
    }

    public function editPcb(Request $request, $id)
    {
        $pcbs = Pcb::find($id);

        return view('pages.admin.settings.edit-pcb', [
            'pcbs' => $pcbs
        ]);
    }

    public function editCompanyDeduction(Request $request, $id)
    {
        $deduction = Deduction::find($id);
        return view('pages.admin.settings.edit-deduction', [
            'deduction' => $deduction
        ]);
    }

    public function editCompanySecurities(Request $request, $id)
    {
        $deduction = Deduction::find($id);

        return view('pages.admin.settings.edit-deduction', [
            'deduction' => $deduction
        ]);
    }

    public function editCompanyAddition(Request $request, $id)
    {
        $addition = Addition::find($id);
        return view('pages.admin.settings.edit-addition', [
            'addition' => $addition
        ]);
    }

    // SECTION: POST EDIT
    public function postEditPosition(Request $request, $id)
    {
        $positionData = $request->validate([
            'name' => 'required|unique:employee_positions,name,' . $id . ',id,deleted_at,NULL'
        ]);

        EmployeePosition::find($id)->update($positionData);

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been updated.');
    }

    public function postEditGrade(Request $request, $id)
    {
        $gradeData = $request->validate([
            'name' => 'required|unique:employee_grades,name,' . $id . ',id,deleted_at,NULL'
        ]);

        EmployeeGrade::find($id)->update($gradeData);

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been updated.');
    }
    
    public function postEditSection(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sections,name,'.$id,
        ]);
        
        $section = Section::find($id);
        $section->name = $request['name'];
        $section->save();
        
        return redirect()->route('admin.settings.sections')->with('status', 'Section is updated.');
    }
    
    public function postEditArea(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:areas,name,'.$id,
        ]);
        
        $area = Area::find($id);
        $area->name = $request['name'];
        $area->save();
        
        return redirect()->route('admin.settings.areas')->with('status', 'Area is updated.');
    }
    
    public function postEditBankCode(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'bic_code' => 'required'
        ]);
        
        $bankCode = BankCode::find($id);
        $bankCode->name = $request['name'];
        $bankCode->bic_code = $request['bic_code'];
        $bankCode->save();
        
        return redirect()->route('admin.settings.bank-code')->with('status', 'Bank code is updated.');
    }
    
    public function postEditCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->save();
        
        return redirect()->route('admin.settings.categories')->with('status', 'Category is updated.');
    }
    
    public function postEditEmploymentStatus(Request $request, $id)
    {
        
        $request->validate([
            'code' => 'required|unique:employment_statuses,code,'.$id,
            'name' => 'required'
        ]);
        
        $employmentStatus = EmploymentStatus::find($id);
        if($employmentStatus->can_delete == 1) {
            $employmentStatus->code = $request['code'];
        }
        $employmentStatus->name = $request['name'];
        $employmentStatus->save();
        
        return redirect()->route('admin.settings.employment-status')->with('status', 'Employment Status is updated.');
    }
    
    public function postEditCompanyAsset(Request $request, $id)
    {
        $request->validate([
            'item_code' => 'required|unique:company_assets,item_code,'.$id,
            'item_name' => 'required'
        ]);
        
        $companyAsset = CompanyAsset::find($id);
        $companyAsset->item_code = $request['item_code'];
        $companyAsset->item_name = $request['item_name'];
        $companyAsset->save();
        
        return redirect()->route('admin.settings.company-asset')->with('status', 'Company asset is updated.');
    }

    public function postEditTeam(Request $request, $id)
    {
        $teamData = $request->validate([
            'name' => 'required|unique:teams,name,' . $id . ',id,deleted_at,NULL'
        ]);

        Team::find($id)->update($teamData);
        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been updated.');
    }

    public function postEditCostCentre(Request $request, $id)
    {
        $costCentreData = $request->validate([
            'name' => 'required|unique:cost_centres,name,' . $id . ',id,deleted_at,NULL'
        ]);

        CostCentre::find($id)->update($costCentreData);

        return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been updated.');
    }

    public function postEditDepartment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $id . ',id,deleted_at,NULL',
            'hod' => 'required'
        ]);

        DB::beginTransaction();
        $department = Department::find($id);
        $department->name = $request->name;
        $department->save();
        
        DepartmentHod::where('department_id', $id)->delete();
        
        foreach($request->hod as $employeeId) {
            $departmentHod = new DepartmentHod();
            $departmentHod->department_id = $department->id;
            $departmentHod->employee_id = $employeeId;
            $departmentHod->save();
        }
        
        DB::commit();
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
            'sunday' => 'required'
        ]);

        EmployeeWorkingDay::templates()->find($id)->update($workingDayData);

        return redirect()->route('admin.settings.working-days')->with('status', 'Working Days has successfully been updated.');
    }

    public function postEditBranch(Request $request, $id)
    {
        $branchData = $request->validate([
            'name' => 'required|unique:branches,name,' . $id . ',id,deleted_at,NULL',
            'contact_no_primary' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'contact_no_secondary' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'fax_no' => 'nullable|regex:/^01?[0-9]\-*\d{7,8}$/',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'country_code' => 'nullable|integer',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required|numeric|digits:5',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area_id' => 'required',
            'state_holiday' => 'required'
        ], [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        Branch::find($id)->update($branchData);

        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been updated.');
    }

    public function postEditCompany(Request $request, $id)
    {
        $companyData = $request->validate([
            'name' => 'required|unique:companies,name,' . $id . ',id,deleted_at,NULL',
            'url' => 'required|url',
            'registration_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'phone' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'tax_no' => 'required',
            'epf_no' => 'required',
            'socso_no' => 'required',
            'eis_no' => 'required',
            'code' => 'required|unique:companies,code,' . $id,
            'status' => 'required',
            'postcode' => 'required|numeric'
        ], [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);

        Company::find($id)->update($companyData);

        return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been updated.');
    }

    public function postEditEpf(Request $request, $id)
    {
        $epfData = $request->validate([
            'category' => 'required', // 'unique:epfs,category,'.$id.',id,deleted_at,NULL',
            'salary' => 'required|numeric',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $epf = EPF::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ],
            [
                'id',
                '!=',
                $id
            ]
        ])->whereNull('deleted_at')->get();

        if ($epf->isEmpty()) {
            EPF::find($id)->update($epfData);
            return redirect()->route('admin.settings.epf')->with('status', 'EPF has successfully been updated.');
        } else {
            return redirect()->route('admin.settings.epf')->with('status', 'Data already exists.');
        }
    }

    public function postEditEis(Request $request, $id)
    {
        $eisData = $request->validate([
            'category' => 'required',
            'salary' => 'required|numeric',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $eis = Eis::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ],
            [
                'id',
                '!=',
                $id
            ]
        ])->whereNull('deleted_at')->get();

        if ($eis->isEmpty()) {
            Eis::find($id)->update($eisData);
            return redirect()->route('admin.settings.eis')->with('status', 'EIS has successfully been updated.');
        } else {
            return redirect()->route('admin.settings.eis')->with('status', 'Data already exists.');
        }
    }

    public function postEditSocso(Request $request, $id)
    {
        $socsoData = $request->validate([
            'category' => 'required',
            'salary' => 'required', // 'required|unique:socsos,salary,'.$id.',id,deleted_at,NULL',
            'employer' => 'required|numeric',
            'employee' => 'required|numeric'
        ]);

        $socso = Socso::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ],
            [
                'id',
                '!=',
                $id
            ]
        ])->whereNull('deleted_at')->get();

        if ($socso->isEmpty()) {
            Socso::find($id)->update($socsoData);
            return redirect()->route('admin.settings.socso')->with('status', 'SOCSO has successfully been updated.');
        } else {
            return redirect()->route('admin.settings.socso')->with('status', 'Data already exists.');
        }
    }

    public function postEditPcb(Request $request, $id)
    {
        $pcbData = $request->validate([
            'category' => 'required',//|unique:pcbs,category,' . $id . ',id,deleted_at,NULL',
            'salary' => 'required',
            'amount' => 'required',
            'total_children' => 'required'
        ]);
        
        $pcb = Pcb::where([
            [
                'category',
                $request['category']
            ],
            [
                'salary',
                $request['salary']
            ],
            [
                'total_children',
                $request['total_children']
            ],
            [
                'id',
                '!=',
                $id
            ]
        ])->whereNull('deleted_at')->get();
        
        if ($pcb->isEmpty()) {
            Pcb::find($id)->update($pcbData);
            return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been updated.');
        } else {
            return redirect()->route('admin.settings.pcb')->with('status', 'Data already exists.');
        }
    }

    public function postEditCompanyDeduction(Request $request)
    {
        $id = $request->id;
        $updateValidatedDeductionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory' => 'nullable',
            'status' => 'required',
            'ea_form_id' => 'nullable',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        $updateValidatedDeductionData['statutory'] = empty($updateValidatedDeductionData['statutory']) ? null : implode(",", $request->statutory);
        $updateValidatedDeductionData['confirmed_employee'] = $request->input('confirmed_employee');
        $updateValidatedDeductionData['cost_centre'] = empty($updateValidatedDeductionData['cost_centre']) ? null : implode(",", $request->cost_centre);
        $updateValidatedDeductionData['employee_grade'] = empty($updateValidatedDeductionData['employee_grade']) ? null : implode(",", $request->employee_grade);
        $updateValidatedDeductionData['company_id'] = $id;

        Deduction::find($request->company_deduction_id)->update($updateValidatedDeductionData);
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Deduction Group has successfully been updated.');
    }

    public function postEditCompanyBank(Request $request)
    {
        $id = $request->id;
        $updateCompanyBankData = $request->validate([
            'bank_code' => 'required',
            'acc_name' => 'required',
            'status' => 'required'
        ]);

        $updateCompanyBankData['company_id'] = $id;
        $updateCompanyBankData['updated_by'] = auth()->user()->name;
        CompanyBank::find($request->company_bank_id)->update($updateCompanyBankData);

        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Company Bank has successfully been updated.');
    }
    
    public function postEditJobCompany(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required'
        ]);
        $jobCompany = JobCompany::where('company_name','=',$request->company_name)
            ->where('id','!=',$request->job_company_id)
            ->where('company_id','=',$id)->count();
        
        if ($jobCompany == 0) {
            $jobCompany = JobCompany::find($request->job_company_id);
            $jobCompany->company_name = $request['company_name'];
            $jobCompany->save();
            
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $id
            ])->with('status', 'Job Company is updated.');
        } else {
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $id
            ])->with('status', 'The Company Name has already been taken.');
        }
    }
    
    public function postEditCompanyAddition(Request $request)
    {
        $id = $request->id;
        $updateValidatedAdditionData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'statutory' => 'nullable',
            'status' => 'required',
            'ea_form_id' => 'nullable',
            'cost_centre' => 'nullable',
            'employee_grade' => 'nullable'
        ]);

        $updateValidatedAdditionData['statutory'] = empty($updateValidatedAdditionData['statutory']) ? null : implode(",", $request->statutory);
        $updateValidatedAdditionData['confirmed_employee'] = $request->input('confirmed_employee');
        $updateValidatedAdditionData['cost_centre'] = empty($updateValidatedAdditionData['cost_centre']) ? null : implode(",", $request->cost_centre);
        $updateValidatedAdditionData['employee_grade'] = empty($updateValidatedAdditionData['employee_grade']) ? null : implode(",", $request->employee_grade);
        $updateValidatedAdditionData['company_id'] = $id;

        Addition::find($request->company_addition_id)->update($updateValidatedAdditionData);
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $id
        ])->with('status', 'Addition Group has successfully been updated.');
    }

    public function postEditSecurityGroup(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $securityGroup = SecurityGroup::where('name','=',$request->name)
            ->where('company_id','=',$company->id)
            ->where('id','!=', $id)
            ->count();
        
        if ($securityGroup == 0) {
            $securityGroup = SecurityGroup::find($id);
            $securityGroup->name = $request->name;
            $securityGroup->description = $request->description;
            $securityGroup->save();
            
            return redirect()->route('admin.settings.security-group')->with('status', 'Security Group is updated.');
        }
        else
        {
            return redirect()->route('admin.settings.security-group')->with('status', 'Security Group Name already taken.');
        }
    }

    // Section: DELETE
    public function deleteSecurityGroup($id)
    {
        $securityGroup = SecurityGroup::find($id);
        $name = $securityGroup->name;
        $securityGroup->delete();
        
        return redirect()->route('admin.settings.security-group')->with('status', $name.' is deleted.');
    }
    
    public function deleteCostCentre(Request $request, $id)
    {
        $employee_job_cost_centre = EmployeeJob::where('cost_centre_id','=',$id)->count();
        $addition_cost_centre = Addition::where('cost_centre', 'like', '%' . $id . '%')->count();
        $deduction_cost_centre = Deduction::where('cost_centre', 'like', '%' . $id . '%')->count();
        
        if ($addition_cost_centre == 0 && $employee_job_cost_centre == 0 && $deduction_cost_centre == 0)
        {
        CostCentre::find($id)->delete();
        return redirect()->route('admin.settings.cost-centres')->with('status', 'Cost Centre has successfully been deleted.');
    }
        else
        {
        return redirect()->route('admin.settings.cost-centres')->with('status', 'You Cannot Delete This Record');
        }
    }

    public function deleteDepartment(Request $request, $id)
    {
        $employee_job_department= EmployeeJob::where('department_id','=',$id)->count();

        if ($employee_job_department == 0)
        {
            Department::find($id)->delete();
            DepartmentHod::where('department_id', $id)->delete();
    
            return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been deleted.');
        }
        else
        {
            return redirect()->route('admin.settings.departments')->with('status', 'You are not allowed to delete this department. Reason: Already used in Employee Job');
        }
    }

    public function deleteGrade(Request $request, $id)
    {
        $employee_job_grade= EmployeeJob::where('emp_grade_id','=',$id)->count();
        $addition_grade = Addition::where('employee_grade', 'like', '%' . $id . '%')->count();
        $deduction_grade = Deduction::where('employee_grade', 'like', '%' . $id . '%')->count();

        if ($employee_job_grade == 0 && $addition_grade == 0 && $deduction_grade == 0)
        {
        EmployeeGrade::find($id)->delete();

        return redirect()->route('admin.settings.grades')->with('status', 'Grade has successfully been deleted.');
    }
        else
        {
        return redirect()->route('admin.settings.grades')->with('status', 'You Cannot Delete This Record');
        }
    }
    
    public function deleteSection($id)
    {
        $section = Section::find($id);
        $name = $section->name;
        $section->delete();
        
        return redirect()->route('admin.settings.sections')->with('status', $name.' is deleted.');
    }
    
    public function deleteArea($id)
    {
        $area = Area::find($id);
        $name = $area->name;
        $area->delete();
        
        return redirect()->route('admin.settings.areas')->with('status', $name.' is deleted.');
    }
    
    public function deleteBankCode($id)
    {
        $bankCode = BankCode::find($id);
        $name = $bankCode->name;
        $bankCode->delete();
        
        return redirect()->route('admin.settings.bank-code')->with('status', $name.' is deleted.');
    }
    
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $name = $category->name;
        $category->delete();
        
        return redirect()->route('admin.settings.categories')->with('status', $name.' is deleted.');
    }
    
    public function deleteEmploymentStatus($id)
    {
        $employmentStatus = EmploymentStatus::find($id);
        
        if($employmentStatus->can_delete == 1) {
            $code = $employmentStatus->code;
            $employmentStatus->delete();
            
            return redirect()->route('admin.settings.employment-status')->with('status', $code.' is deleted.');
        } else {
            return redirect()->route('admin.settings.employment-status')->with('status', 'Cannot delete '.$code);
        }
    }
    
    public function deleteCompanyAsset($id)
    {
        $companyAsset = CompanyAsset::find($id);
        $code = $companyAsset->item_code;
        $companyAsset->delete();
        
        return redirect()->route('admin.settings.company-asset')->with('status', $code.' is deleted.');
    }

    public function deleteCompany(Request $request, $id)
    {
        $employee_company= Employee::where('company_id','=',$id)->count();

        if ($employee_company == 0) {
            Company::find($id)->delete();
    
            return redirect()->route('admin.settings.companies')->with('status', 'Company has successfully been deleted.');
        } else {
            return redirect()->route('admin.settings.companies')->with('status', 'You Cannot Delete This Record');
        }
    }
    
    public function deleteCompanyBank($id)
    {
        $bank = CompanyBank::find($id);
        $companyId = $bank->company_id; 
        $bank->delete();
        
        return redirect()->route('admin.settings.company.company-details', [
            'id' => $companyId
        ])->with('status', 'Company Bank is deleted.');
    }
    
    public function deleteJobCompany($id)
    {
        // cannot delete default company, id = 1
        $jobCompany = JobCompany::find($id);
        $companyId = $jobCompany->company_id;
        $companyName = $jobCompany->company_name;
        
        if ($id > 1) {
            $jobCompany->delete();
            
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $companyId
            ])->with('status', $companyName.' is deleted.');
        } else {
            return redirect()->route('admin.settings.company.company-details', [
                'id' => $companyId
            ])->with('status', 'Cannot delete '.$companyName);
        }
    }

    public function deleteTeam(Request $request, $id)
    {
        $employee_job_team= EmployeeJob::where('team_id','=',$id)->count();

        if ($employee_job_team == 0)
        {
        Team::find($id)->delete();

        return redirect()->route('admin.settings.teams')->with('status', 'Team has successfully been deleted.');
    }
        else
        {
        return redirect()->route('admin.settings.teams')->with('status', 'You Cannot Delete This Record');
        }
    }

    public function deleteBranch(Request $request, $id)
    {
        $company_branch= EmployeeJob::where('branch_id','=',$id)->count();

        if ($company_branch == 0)
        {
        Branch::find($id)->delete();
        return redirect()->route('admin.settings.branches')->with('status', 'Branch has successfully been deleted.');
    }
        else
        {
        return redirect()->route('admin.settings.branches')->with('status', 'You Cannot Delete This Record');
        }
    }

    public function deletePosition(Request $request, $id)
    {
        $employee_position= EmployeeJob::where('emp_mainposition_id','=',$id)->count();

        if ($employee_position == 0)
        {
        EmployeePosition::find($id)->delete();

        return redirect()->route('admin.settings.positions')->with('status', 'Position has successfully been deleted.');
    }
        else
        {
        return redirect()->route('admin.settings.positions')->with('status', 'You Cannot Delete This Record');
        }
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
        $employee_pcb_group = Employee::where('pcb_group','=',$id)->count();

        if ($employee_pcb_group == 0) {
            Pcb::find($id)->delete();
    
            return redirect()->route('admin.settings.pcb')->with('status', 'PCB has successfully been deleted.');
        } else {
            return redirect()->route('admin.settings.pcb')->with('status', 'You cannot delete this record');
        }
    }
    
    public function showBranch($id)
    {
        $branch = Branch::find($id);
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $areas = Area::where('company_id', $company->id)->get();
        
        return view('pages.admin.settings.show-branch', [
            'branch' => $branch,
            'areas' => $areas,
        ]);
    }
    
    public function importPcb($fileName, $noOfCategory)
    {
        $collection = (new PcbImport())->toCollection($fileName); // ,'pcb\p02.xlsx');
                                                                  // dd(($collection));
        $pcbs = array();
        $rowCount = 0;

        if ($noOfCategory == 2) {
            $maxCell = 22;
        } else {
            $maxCell = 25;
        }

        foreach ($collection[0] as $row) {
            if ($rowCount < 11) {
                $rowCount ++;
                continue;
            }

            if ($row[2] != null && is_numeric($row[2])) {
                $cellCount = 3;
                $salary = $row[2];
                if ($noOfCategory == 2) {
                    $totalChildren = 11;
                } else {
                    $totalChildren = 0;
                }

                for ($i = $cellCount; $i <= $maxCell; $i ++) {
                    $amount = $row[$cellCount];

                    if ($amount != null && $amount != '-' && is_numeric($amount)) {
                        if ($noOfCategory == 2) {
                            if ($cellCount >= 3 && $cellCount <= 12) {
                                $category = 2;
                            } else if ($cellCount > 12 && $cellCount <= 22) {
                                $category = 3;
                            }
                        } else {
                            if ($cellCount == 3) {
                                $category = 1;
                            } else if ($cellCount > 3 && $cellCount <= 14) {
                                $category = 2;
                            } else if ($cellCount > 14 && $cellCount <= 25) {
                                $category = 3;
                            }
                        }

                        $pcbs[] = [
                            'category' => $category,
                            'total_children' => $totalChildren,
                            'salary' => $salary,
                            'amount' => $amount
                        ];

                        if (($noOfCategory == 3 && $cellCount > 3) || $noOfCategory == 2) {
                            $totalChildren ++;
                        }
                    }

                    if ($noOfCategory == 3 && $totalChildren > 10) {
                        $totalChildren = 0;
                    } else if ($noOfCategory == 2 && $totalChildren > 20) {
                        $totalChildren = 11;
                    }

                    $cellCount ++;
                }
            }

            $rowCount ++;
        }
        // dd($pcbs);
        if (count($pcbs) > 0) {
            foreach (array_chunk($pcbs, 500) as $p) {
                Pcb::insert($p);
            }
        }

        return "Total " . count($pcbs) . " records";
    }
    
    public function getPcbCategory()
    {
        $pcbCategory = Pcb::distinct()->orderBy('category')->get(['category']);
        return response()->json($pcbCategory);
    }
    
    public function getPcbNumberOfChildren()
    {
        $pcbNumberOfChildren = Pcb::distinct()->orderBy('total_children')->get(['total_children']);
        return response()->json($pcbNumberOfChildren);
    }
}
