<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Country;
use App\Roles;
use App\Bank;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\Team;
use App\EmployeePosition;
use App\Company;
use App\Holiday;
use App\LeaveRequest;

use App\User;
use App\Employee;
use App\EmployeeDependent;
use App\EmployeeAttachment;
use App\EmployeeBankAccount;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeImmigration;
use App\EmployeeJob;
use App\EmployeeSkill;
use App\EmployeeVisa;
use App\EmployeeEmergencyContact;
use App\EmployeeGrade;
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\EmployeeWorkingDay;
use App\EmployeeAttendance;

use App\Http\Services\LeaveService;

use App\Http\Requests\Admin\AddEmployee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    public function index()
    {
       // $userlist = User::orderBy('id', 'Desc')->get();
        // $employee_users = User::whereHas("roles", function($q){ $q->where("name", "employee"); })->get();
        // dd($employee_users[0]->employee->id);

        $employees = Employee::all();

        return view('pages.admin.employees.index', ['employees'=> $employees]);
    }


    public function dsplaySecurityGroup($id)
    {

        $employees = Employee::all();

        return view('pages.admin.employees.id.security-group', ['employees'=> $employees]);
    }
    public function display($id)
    {
        $employee = Employee::with('user')
        ->with(['employee_confirmed' => function($query) use ($id)
        {
            $query->where('status','=','confirmed-employment')
            ->where ('emp_id','=',$id);


        }])

        ->find($id);



        // $bank_list = Bank::all();
        // $cost_centre = CostCentre::all();
        // $department = Department::all();
        // $team = Team::all();
        // $position = EmployeePosition::all();
        // $grade = EmployeeGrade::all();
        // $branch = Branch::all();
        // $countries = Country::all();
        // $companies = Company::all();

        return view('pages.admin.employees.id', ['employee' => $employee]);
    }

    public function postEditProfile(Request $request, $id)
    {
        $profileUpdatedData = $request->validate([

            'ic_no' => 'required|numeric',
            'code'=>'',
            'dob' => 'required|date',
            'gender' => 'required',

            'marital_status' => 'required',
            'race' => 'required|alpha',
            'total_children' => 'nullable|numeric',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable',
            'epf_no' => 'required',
            'tax_no' => 'required',
            'eis_no' => 'required',
            'socso_no' => 'required',
            'main_security_group_id'=>'',
          'contact_no' => 'required',
            // 'contact_no' => 'required|regex:/^[0-9]+-/',
        ]);

        Employee::where('id', $id)->update($profileUpdatedData);

        return response()->json(['success'=>'Profile was successfully updated.']);
    }

    public function add()
    {
        $countries = Country::all();
        $roles = Roles::all();

        return view('pages.admin.employees.add', compact('countries','roles'));
    }

    public function postChangePassword(Request $request, $id) {
        $data = $request->validate([
            // 'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_password|same:confirm_new_password',
        ]);

        $employee = Employee::where('id', $id)->first();

        // dd(bcrypt($data['new_password']));

        // if (!(Hash::check($data['current_password'], $employee->user->password))) {
        //     response()->json(['errors'=> [
        //         'current_password' => ['The current password is incorrect.']
        //     ]], 422);
        // }

        User::where('id', $employee->user->id)->update([
            'password' => bcrypt($data['new_password'])
        ]);

        return response()->json(['success'=>'Password was successfully updated.']);
    }


    public function postToggleRoleAdmin(Request $request, $id) {
        $data = $request->validate([
            // 'current_password' => 'required',
            'assign_remove' => 'required',
        ]);

        $employee = Employee::where('id', $id)->first();
        switch($data['assign_remove']) {
            case "assign":
                $employee->user->assignRole('admin');
                break;
            case "remove":
                $employee->user->removeRole('admin');
                break;
        }

        return response()->json(['success'=>'Employee roles were successfully updated.']);
    }

    // SECTION: Data Tables

    public function getDataTableDependents($id)
    {
        $dependents = EmployeeDependent::where('emp_id', $id)->get();

        return DataTables::of($dependents)
        ->editColumn('dob', function ($dependent) {
            return date('d/m/Y', strtotime($dependent->dob) );
        })
        ->editColumn('alt_dob', function ($dependent) {
            return date('Y-m-d', strtotime($dependent->dob) );
        })
        ->make(true);
    }

    public function getDataTableImmigrations($id)
    {
        $immigrations = EmployeeImmigration::where('emp_id', $id)->get();

        return DataTables::of($immigrations)
        ->editColumn('issued_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->issued_date) );
        })
        ->editColumn('expiry_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->expiry_date) );
        })
        ->editColumn('alt_issued_date', function ($immigration) {
            return date('Y-m-d', strtotime($immigration->issued_date) );
        })
        ->editColumn('alt_expiry_date', function ($immigration) {
            return date('Y-m-d', strtotime($immigration->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableVisas($id)
    {
        $visas = EmployeeVisa::where('emp_id', $id)->get();
        return DataTables::of($visas)
        ->editColumn('issued_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->issued_date) );
        })
        ->editColumn('expiry_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->expiry_date) );
        })
        ->editColumn('alt_issued_date', function ($visa) {
            return date('Y-m-d', strtotime($visa->issued_date) );
        })
        ->editColumn('alt_expiry_date', function ($visa) {
            return date('Y-m-d', strtotime($visa->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableJobs($id)
    {
        $jobs = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', $id)->get();
        return DataTables::of($jobs)
        ->editColumn('start_date', function ($job) {
            return date('d/m/Y', strtotime($job->start_date) );
        })
        ->editColumn('alt_start_date', function ($job) {
            return date('Y-m-d', strtotime($job->start_date) );
        })
        ->make(true);
    }

    public function getDataTableBankAccounts($id)
    {
        $banks = EmployeeBankAccount::where('emp_id', $id)->get();
        return DataTables::of($banks)->make(true);
    }


    public function getDataTableExperiences($id)
    {
        $experiences = EmployeeExperience::where('emp_id', $id)->get();
        return DataTables::of($experiences)
        ->editColumn('start_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->start_date) );
        })
        ->editColumn('end_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->end_date) );
        })
        ->editColumn('alt_start_date', function ($experience) {
            return date('Y-m-d', strtotime($experience->start_date) );
        })
        ->editColumn('alt_end_date', function ($experience) {
            return date('Y-m-d', strtotime($experience->end_date) );
        })
        ->make(true);
    }

    public function getDataTableEducation($id)
    {
        $educations = EmployeeEducation::where('emp_id', $id)->get();
        return DataTables::of($educations)->make(true);
    }

    public function getDataTableSkills($id)
    {
        $skills = EmployeeSkill::where('emp_id', $id)->get();
        return DataTables::of($skills)->make(true);
    }

    public function getDataTableAttachments($id)
    {
        $attachments = EmployeeAttachment::where('emp_id', $id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableEmergencyContacts($id)
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', $id)->get();
        return DataTables::of($contacts)->make(true);
    }

    public function getDataTableReportTo($id)
    {
        $reportTos = EmployeeReportTo::with('employee_report_to.user')->where('emp_id', $id)->get();
        return DataTables::of($reportTos)->make(true);
    }

    public function getDataTableMainSecurityGroup($id)
    {
        $employee = Employee::with('security_groups')->where('emp_id', $id)->get();
        return DataTables::of($employee)->make(true);
    }

    public function getDataTableSecurityGroup($id)
    {
        $security_groups = EmployeeSecurityGroup::with('security_groups')->where('emp_id', $id)->get();
        return DataTables::of($security_groups)->make(true);
    }

    protected function postAdd(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|required_with:confirm_password|same:confirm_password',

            'code'=>'unique:employees',
            'contact_no' => 'required',
            'address' => 'required',
            'company_id' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'race' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            'total_children' => 'nullable|numeric',
            'ic_no' => 'required|unique:employees,ic_no',
            'tax_no' => 'required|unique:employees,tax_no|numeric',
            'epf_no' => 'required|unique:employees,epf_no|numeric',
            'eis_no' => 'required|unique:employees,eis_no|numeric',
            'socso_no' => 'required|unique:employees,socso_no|numeric',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable|date',
            'main_security_group_id'=>'nullable'
        ]);


        $validatedUserData['name'] = $validated['name'];
        $validatedUserData['email'] = $validated['email'];
        $validatedUserData['password'] = Hash::make($validated['password']);

        $validatedEmployeeData['code'] = $validated['code'];
        $validatedEmployeeData['contact_no'] = $validated['contact_no'];
        $validatedEmployeeData['address'] = $validated['address'];
        $validatedEmployeeData['company_id'] = $validated['company_id'];
        $validatedEmployeeData['dob'] = $validated['dob'];
        $validatedEmployeeData['gender'] = $validated['gender'];
        $validatedEmployeeData['race'] = $validated['race'];
        $validatedEmployeeData['nationality'] = $validated['nationality'];
        $validatedEmployeeData['marital_status'] = $validated['marital_status'];
        $validatedEmployeeData['total_children'] = $validated['total_children'];
        $validatedEmployeeData['ic_no'] = $validated['tax_no'];
        $validatedEmployeeData['tax_no'] = $validated['tax_no'];
        $validatedEmployeeData['epf_no'] = $validated['epf_no'];
        $validatedEmployeeData['eis_no'] = $validated['eis_no'];
        $validatedEmployeeData['socso_no'] = $validated['socso_no'];
        $validatedEmployeeData['driver_license_no'] = $validated['driver_license_no'];
        $validatedEmployeeData['driver_license_expiry_date'] = $validated['driver_license_expiry_date'];
        $validatedEmployeeData['main_security_group_id'] = $validated['main_security_group_id'];

        // $validatedEmployeeData = $request->validate([
        // ]);
        // dd($validatedEmployeeData);

        DB::transaction(function () use ($validatedUserData, $validatedEmployeeData) {
            $user = User::create($validatedUserData);
            $user->assignRole('employee');


            $validatedEmployeeData['user_id'] = $user->id;
            $validatedEmployeeData['created_by'] = auth()->user()->id;
            $employee = Employee::create($validatedEmployeeData);
        });

        return redirect()->route('admin.employees')->with('status', 'Employee successfully added!');
    }


    // SECTION: Add
    public function postEmergencyContact(Request $request, $id)
    {
        $emergencyContactData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|numeric',
        ]);
        $emergencyContactData['created_by'] = auth()->user()->id;
        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);

        $employee = Employee::find($id);
        $employee->employee_emergency_contacts()->save($emergencyContact);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postDependent(Request $request, $id)
    {
        $dependentData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentData['dob'] = implode("-", array_reverse(explode("/", $dependentData['dob'])));
        $dependentData['created_by'] = auth()->user()->id;
        $dependent = new EmployeeDependent($dependentData);

        $employee = Employee::find($id);
        $employee->employee_dependents()->save($dependent);

        return response()->json(['success'=>'Dependent is successfully added']);
    }

    public function postImmigration(Request $request, $id)
    {
        $immigrationData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date'
        ]);
        $immigrationData['created_by'] = auth()->user()->id;
        $immigration = new EmployeeImmigration($immigrationData);

        $employee = Employee::find($id);
        $employee->employee_immigrations()->save($immigration);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postVisa(Request $request, $id)
    {
        $visaData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            // 'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'family_members' => 'required'
        ]);
        $visaData['created_by'] = auth()->user()->id;
        $visa = new EmployeeVisa($visaData);

        $employee = Employee::find($id);
        $employee->employee_visas()->save($visa);

        return response()->json(['success'=>'Visa is successfully added']);
    }

    public function postJob(Request $request, $id)
    {
        // Add a new job

        $jobData = $request->validate([
            'basic_salary' => 'required|numeric',
            'cost_centre_id' => 'required',
            'department_id' => 'required',
            'team_id' => 'required',
            'emp_mainposition_id' => 'required',
            'emp_grade_id' => 'required',
            'basic_salary' => 'required',
            'remarks' => '',
            'branch_id' => 'required',
            'start_date' => 'required|date',
            'status' => 'required',
        ]);

        $jobData['created_by'] = auth()->user()->id;
        // $jobData['status'] = 'active';
        // $jobData['start_date'] = date("Y-m-d", strtotime($jobData['start_date']));

        // $end_date = EmployeeJob::where('id', $id)
        // ->whereNull('end_date');

        // $jobData['status'] = 'active';
        $jobData['start_date'] = date("Y-m-d", strtotime($jobData['start_date']));

        DB::transaction(function() use ($jobData, $id) {
            $currentJob = EmployeeJob::where('emp_id', $id)
            ->whereNull('end_date')->first();

            if(!empty($currentJob)) {
                $currentJob->update(['end_date'=> date("Y-m-d", strtotime($jobData['start_date']))]);
                LeaveService::onJobEnd($id, $jobData['start_date'], $currentJob->emp_grade_id);
            }

            $employee = Employee::find($id);
            $employee->employee_jobs()->save(new EmployeeJob($jobData));
            LeaveService::onJobStart($id, $jobData['start_date'], (int)$jobData['emp_grade_id']);
        });

        return response()->json(['success'=>'Job is successfully added']);
    }

    public function actionResign(Request $request, $id) {
        // EmployeeJob::where('emp_id', $id)
        // ->whereNull('end_date')
        // ->update(array('end_date'=> date("Y-m-d", strtotime($jobData['start_date']))));
        $job = new EmployeeJob($jobData);


        $currentJob = EmployeeJob::where('emp_id', $id)
            ->whereNull('end_date')->first();
        $currentDate = date("Y-m-d");
        if(!empty($currentJob)) {
            $currentJob->update(['end_date'=> $currentDate ]);
            LeaveService::onJobEnd($id, $currentDate, $currentJob->emp_grade_id);
        }
    }

    public function postBankAccount(Request $request, $id)
    {
        $bankAccountData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required',
            'acc_status' => 'required'
        ]);
        $bankAccountData['created_by'] = auth()->user()->id;
        $bankAccount = new EmployeeBankAccount($bankAccountData);

        $employee = Employee::find($id);
        $employee->employee_bank_accounts()->save($bankAccount);

        return response()->json(['success'=>'Record is successfully added']);

        // $type = $request->input('type');
        // $bank_code = Input::get('bank_list');
        // $acc_no = $request->input('acc_no');
        // $status = Input::get('status');
        // $created_by = auth()->user()->id;

        // DB::insert('insert into employee_bank_accounts
        // (emp_id, type, bank_code, acc_no, acc_status, created_by)
        // values
        // (?,?,?,?,?,?)',
        // [$id, $type, $bank_code, $acc_no, $status, $created_by]);

        // return redirect()->route('admin.employees.id', ['id' => $id]);
    }

    public function postCompany(Request $request, $id)
    {
        $experienceData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notes'=>''

        ]);
        $experienceData['created_by'] = auth()->user()->id;
        $experience = new EmployeeExperience($experienceData);

        $employee = Employee::find($id);
        $employee->employee_experiences()->save($experience);

        return response()->json(['success'=>'Experience is successfully added']);
    }

    public function postEducation(Request $request, $id)
    {
        $educationData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'end_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|between:0,99.99',
            'description' => 'required'
        ]);
        $educationData['created_by'] = auth()->user()->id;
        $education = new EmployeeEducation($educationData);

        $employee = Employee::find($id);
        $employee->employee_educations()->save($education);

        return response()->json(['success'=>'Education is successfully added']);
    }

    public function postSkill(Request $request, $id)
    {
        $skillData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required',
            'competency' => 'required'
        ]);
        $skillData['created_by'] = auth()->user()->id;
        $skill = new EmployeeSkill($skillData);

        $employee = Employee::find($id);
        $employee->employee_skills()->save($skill);

        return response()->json(['success'=>'Skill is successfully added']);
    }

    public function postAttachment(Request $request, $id)
    {
        $attachmentData = $request->validate([
            'name' => 'required',
            'notes' => 'required'
        ]);
        $attachmentData['created_by'] = auth()->user()->id;
        $attachment = new EmployeeAttachment($attachmentData);

        $employee = Employee::find($id);
        $employee->employee_attachments()->save($attachment);

        return response()->json(['success'=>'Attachment is successfully added']);
    }

    // SECTION: Employee Working Day Setup
    public function postWorkingDay(Request $request, $id)
    {
        $workingDayData = $request->validate([
            'monday' => 'required|in:0,0.5,1',
            'tuesday' => 'required|in:0,0.5,1',
            'wednesday' => 'required|in:0,0.5,1',
            'thursday' => 'required|in:0,0.5,1',
            'friday' => 'required|in:0,0.5,1',
            'saturday' => 'required|in:0,0.5,1',
            'sunday' => 'required|in:0,0.5,1',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
        ]);
        $workingDaysData['is_template'] = false;
        $workingDaysData['created_by'] = auth()->user()->id;
        $workingDay = new EmployeeWorkingDay($workingDayData);

        $employee = Employee::find($id);
        $employee->working_day()->save($workingDay);

        return response()->json(['success' => 'Working Day is successfully added']);

    }

    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayUpdateData = $request->validate([
            'monday' => 'required|in:0,0.5,1',
            'tuesday' => 'required|in:0,0.5,1',
            'wednesday' => 'required|in:0,0.5,1',
            'thursday' => 'required|in:0,0.5,1',
            'friday' => 'required|in:0,0.5,1',
            'saturday' => 'required|in:0,0.5,1',
            'sunday' => 'required|in:0,0.5,1',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
        ]);
        $workingDayUpdateData['is_template'] = false;
        EmployeeWorkingDay::where('emp_id', $id)->update($workingDayUpdateData);

        return response()->json(['success'=>'Working Day was successfully updated.']);
    }

    public function getWorkingDay($id)
    {
        $working_day = EmployeeWorkingDay::templates()->where('id', $id)->get();

        return response()->json($working_day);
    }

    public function getEmployeeWorkingDay($emp_id)
    {
        $working_day = EmployeeWorkingDay::where('emp_id', $emp_id)->get();

        return response()->json($working_day);
    }

    public function postReportTo(Request $request, $id)
    {
        $reportToData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',

            'notes' => '',
            'report_to_level' =>'required',
            'kpi_proposer' => 'sometimes|required',

        ]);
        if($request->get('kpi_proposer') == null){
            $reportToData['kpi_proposer'] = 0;
        } else {
            $reportToData['kpi_proposer'] = request('kpi_proposer');
        }

        $reportToData['created_by'] = auth()->user()->id;
        $reportTo = new EmployeeReportTo($reportToData);

        $employee = Employee::find($id);
        $employee->report_tos()->save($reportTo);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postSecurityGroup(Request $request, $id)
    {
        $securityGroupData = $request->validate([
            'security_group_id' => 'required|unique:employee_security_groups,security_group_id,NULL,id,deleted_at,NULL,emp_id,'.$id
        ]);
        $securityGroupData['created_by'] = auth()->user()->id;
        $securityGroup = new EmployeeSecurityGroup($securityGroupData);

        $employee = Employee::find($id);
        $employee->employee_security_groups()->save($securityGroup);

        return response()->json(['success'=>'Security Group was successfully updated.']);
    }


    public function postMainSecurityGroup(Request $request, $id)
    {
        $mainSecurityGroupData = $request->validate([
            'main_security_group_id' => 'required'
        ]);

        Employee::update(array('main_security_group_id' => $mainSecurityGroupData));

        return response()->json(['success'=>'Security Group was successfully updated.']);
    }

    // SECTION: Edit
    public function postEditEmergencyContact(Request $request, $emp_id, $id)
    {
        $emergencyContactUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|numeric',
        ]);

        EmployeeEmergencyContact::where('id', $id)->update($emergencyContactUpdatedData);

        return response()->json(['success'=>'Emergency Contact was successfully updated.']);
    }

    public function postEditDependent(Request $request, $emp_id, $id)
    {
        $dependentUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentUpdatedData['dob'] = implode("-", array_reverse(explode("/", $dependentUpdatedData['dob'])));

        EmployeeDependent::where('id', $id)->update($dependentUpdatedData);

        return response()->json(['success'=>'Dependent was successfully updated.']);
    }

    public function postEditImmigration(Request $request, $emp_id, $id)
    {
        $immigrationUpdatedData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date'
        ]);

        EmployeeImmigration::where('id', $id)->update($immigrationUpdatedData);

        return response()->json(['success'=>'Immigration was successfully updated.']);
    }

    public function postEditVisa(Request $request, $emp_id, $id)
    {
        $visaUpdatedData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            // 'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'family_members' => 'required'
        ]);

        EmployeeVisa::where('id', $id)->update($visaUpdatedData);

        return response()->json(['success'=>'Visa was successfully updated.']);
    }

    public function postEditJob(Request $request, $emp_id, $id)
    {

        $jobData = $request->validate([
            'branch_id' => 'required',
            'emp_mainposition_id' => 'required',
            'department_id' => 'required',
            'team_id' => 'required',
            'cost_centre_id' => 'required',
            'emp_grade_id' => 'required',
            'start_date' => 'required',
            'basic_salary' => 'required',
            'remarks' => '',
            'status' => 'required'
        ]);

        // $jobData['status'] = 'active';
        $jobData['start_date'] = date("Y-m-d", strtotime($jobData['start_date']));

        EmployeeJob::where('id', $id)->update($jobData);

        return response()->json(['success'=>'Job is successfully updated.']);
    }

    public function postEditBankAccount(Request $request, $emp_id, $id)
    {
        $bankAccountUpdateData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric',
            'acc_status' => 'required'
        ]);

        EmployeeBankAccount::where('id', $id)->update($bankAccountUpdateData);

        return response()->json(['success'=>'Bank Account was successfully updated.']);
    }

    public function postEditCompany(Request $request, $emp_id, $id)
    {
        $experienceUpdatedData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notes' => 'required'
        ]);

        EmployeeExperience::where('id', $id)->update($experienceUpdatedData);

        return response()->json(['success'=>'Experience was successfully updated.']);
    }

    public function postEditEducation(Request $request, $emp_id, $id)
    {
        $educationUpdatedData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'end_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|between:0,99.99',
            'description' => ''
        ]);

        EmployeeEducation::where('id', $id)->update($educationUpdatedData);

        return response()->json(['success'=>'Education was successfully updated.']);
    }

    public function postEditSkill(Request $request, $emp_id, $id)
    {
        $skillUpdatedData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required',
            'competency' => 'required',
        ]);

        EmployeeSkill::where('id', $id)->update($skillUpdatedData);

        return response()->json(['success'=>'Skill was successfully updated.']);
    }

    public function postEditReportTo(Request $request, $emp_id, $id)
    {
        $reportToUpdatedData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'kpi_proposer' => 'required',
            'notes' => 'required',
            'report_to_level'=>'required'
        ]);

        EmployeeReportTo::where('id', $id)->update($reportToUpdatedData);

        return response()->json(['success'=>'Report To was successfully updated.']);
    }

    public function postEditAttachment(Request $request, $emp_id, $id)
    {
        $attachmentUpdatedData = $request->validate([
            'name' => 'required',
            'notes' => 'required'
        ]);

        EmployeeAttachment::where('id', $id)->update($attachmentUpdatedData);

        return response()->json(['success'=>'Attachment was successfully updated.']);
    }



    //delete function
    public function deleteEmergencyContact(Request $request, $emp_id, $id)
    {
        EmployeeEmergencyContact::find($id)->delete();
        return response()->json(['success'=>'Emergency Contact was successfully deleted.']);
    }

    public function deleteDependent(Request $request, $emp_id, $id)
    {
        EmployeeDependent::find($id)->delete();
        return response()->json(['success'=>'Dependent was successfully deleted.']);
    }

    public function deleteImmigration(Request $request, $emp_id, $id)
    {
        EmployeeImmigration::find($id)->delete();
        return response()->json(['success'=>'Immigration was successfully deleted.']);
    }

    public function deleteVisa(Request $request, $emp_id, $id)
    {
        EmployeeVisa::find($id)->delete();
        return response()->json(['success'=>'Visa was successfully deleted.']);
    }

    public function deleteBankAccount(Request $request, $emp_id, $id)
    {
        EmployeeBankAccount::find($id)->delete();
        return response()->json(['success'=>'Bank Account was successfully deleted.']);
    }

    public function deleteExperience(Request $request, $emp_id, $id)
    {
        EmployeeExperience::find($id)->delete();
        return response()->json(['success'=>'Experience was successfully deleted.']);
    }

    public function deleteEducation(Request $request, $emp_id, $id)
    {
        EmployeeEducation::find($id)->delete();
        return response()->json(['success'=>'Education was successfully deleted.']);
    }

    public function deleteSkill(Request $request, $emp_id, $id)
    {
        EmployeeSkill::find($id)->delete();
        return response()->json(['success'=>'Skill was successfully deleted.']);
    }
    public function deleteAttachment(Request $request, $emp_id, $id)
    {
        EmployeeAttachment::find($id)->delete();
        return response()->json(['success'=>'Attachment was successfully deleted.']);
    }

    public function deleteReportTo(Request $request, $emp_id, $id)
    {
        EmployeeReportTo::find($id)->delete();
        return response()->json(['success'=>'Report To was successfully deleted.']);
    }

    public function deleteSecurityGroup(Request $request, $emp_id, $id)
    {
        EmployeeSecurityGroup::find($id)->delete();
        return response()->json(['success'=>'Security Group was successfully deleted.']);
    }


    public function postDisapproved(Request $request)
    {

        $id = $request->input('id');
        $emp_id = $request->input('emp_id');
        $leave_type_id = $request->input('leave_type_id');
        $total_days =$request->input('total_days');

        $leaveAllocationData1 = LeaveAllocation::select ('spent_days')->where('emp_id',$emp_id)
        ->where('leave_type_id',$leave_type_id)->first()->spent_days;


        $leaveAllocationData = number_format($leaveAllocationData1,1);
        $total_days =number_format($total_days,1);
        $leaveAllocationDataEntry = $leaveAllocationData - $total_days;


        LeaveRequest::where('id',$id)->update(array('status' => 'rejected'));
        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();


        $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
        ->where('leave_type_id',$leave_type_id)
        ->update(array('spent_days'=>$leaveAllocationDataEntry));
            return redirect()->route('leaverequest');

    }

    public function ajaxGetAttendances(Request $request, $id) {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $workingDays = EmployeeWorkingDay::where('emp_id', $id)->first();
        if(empty($workingDays)) {
            return [
                'error' => true,
                'errorMessage' => 'No working days set.'
            ];
        }

        $attendances = EmployeeAttendance::where('emp_id', $id)->whereMonth('clock_in_time', $now->month)->get();
        $holidays = Holiday::where('start_date', '>=', $startOfMonth)
        ->where(function($q) use ($startOfMonth, $endOfMonth) {
            $q->where('start_date', '>=', $startOfMonth);
            $q->where('start_date', '<=', $endOfMonth);
        })
        ->OrWhere(function($q) use ($startOfMonth, $endOfMonth) {
            $q->where('end_date', '>=', $startOfMonth);
            $q->where('end_date', '<=', $endOfMonth);
        })
        ->where('status', 'active')->get();

        $leaveRequests = LeaveRequest::with('leave_type')->where('emp_id', $id)->where('start_date', '>=', $startOfMonth)
        ->where(function($q) use ($startOfMonth, $endOfMonth) {
            $q->where(function($q) use ($startOfMonth, $endOfMonth) {
                $q->where('start_date', '>=', $startOfMonth);
                $q->where('start_date', '<=', $endOfMonth);
            })
            ->OrWhere(function($q) use ($startOfMonth, $endOfMonth) {
                $q->where('end_date', '>=', $startOfMonth);
                $q->where('end_date', '<=', $endOfMonth);
            });
        })
        ->where('status', 'approved')->get();

        $workingDaysIntArray = $this->getWorkingDaysInIntegerArray($workingDays);

        $period = CarbonPeriod::between($startOfMonth, $endOfMonth);
        $workDaysFilter = function ($date) use ($workingDaysIntArray) {
            return in_array($date->dayOfWeek, $workingDaysIntArray);
        };
        $period->addFilter($workDaysFilter);
        $future = false;
        foreach ($period as $date) {
            $holiday = $this->isAHoliday($holidays, $date);
            if(!empty($holiday)) {
                $days[] = [
                    'date' => $date->toFormattedDateString(),
                    'type' => 'holiday',
                    'name' => $holiday->name
                ];
            } else {
                $leaveRequest = $this->isOnLeave($leaveRequests, $date);
                if(!empty($leaveRequest)) {
                    $days[] = [
                        'date' => $date->toFormattedDateString(),
                        'type' => 'leave',
                        'name' => $leaveRequest->leave_type->name,
                    ];
                } else {
                    if($future) {
                        $days[] = [
                            'date' => $date->toFormattedDateString(),
                            'type' => 'future',
                            'name' => 'Future Date'
                        ];
                    } else {
                        $attendance = $this->hasAttendance($attendances, $date);
                        if(!empty($attendance)) {
                            $days[] = [
                                'date' => $date->toFormattedDateString(),
                                'type' => 'attendance',
                                'name' => 'Clocked-In Attendance',
                                'clock_in_status' => $attendance->clock_in_status,
                                'clock_in_time' => $attendance->clock_in_time,
                                'clock_in_address' => $attendance->clock_in_address,
                                'clock_out_status' => $attendance->clock_out_status,
                                'clock_out_time' => $attendance->clock_out_time,
                                'clock_out_address' => $attendance->clock_out_address,
                            ];
                        } else {

                            $days[] = [
                                'date' => $date->toFormattedDateString(),
                                'type' => 'missing',
                                'name' => "Missing Attendance",
                            ];

                        }
                    }
                }

            }

            if($date->isToday()) {
                $future = true;
            }
        }


        return $days;
    }

    private function getWorkingDaysInIntegerArray($workingDays) {
        $arr = array();
        if($workingDays->sunday > 0) {
            array_push($arr, Carbon::SUNDAY);
        }
        if($workingDays->monday > 0) {
            array_push($arr, Carbon::MONDAY);
        }
        if($workingDays->tuesday > 0) {
            array_push($arr, Carbon::TUESDAY);
        }
        if($workingDays->wednesday > 0) {
            array_push($arr, Carbon::WEDNESDAY);
        }
        if($workingDays->thursday > 0) {
            array_push($arr, Carbon::THURSDAY);
        }
        if($workingDays->friday > 0) {
            array_push($arr, Carbon::FRIDAY);
        }
        if($workingDays->saturday > 0) {
            array_push($arr, Carbon::SATURDAY);
        }

        return $arr;
    }

    private function isAHoliday($holidays, Carbon $date) {
        foreach($holidays as $holiday) {
            $startDate = Carbon::parse($holiday->start_date);
            $endDate = Carbon::parse($holiday->end_date);
            if($date->between($startDate, $endDate)) {
                return $holiday;
            }
        }

        return null;
    }

    private function isOnLeave($leaveRequests, Carbon $date) {
        foreach($leaveRequests as $leaveRequest) {
            $startDate = Carbon::parse($leaveRequest->start_date);
            $endDate = Carbon::parse($leaveRequest->end_date);
            if($date->between($startDate, $endDate)) {
                return $leaveRequest;
            }
        }

        return null;
    }

    private function hasAttendance($attendances, Carbon $date) {
        foreach($attendances as $attendance) {
            $clockInTime = Carbon::parse($attendance->clock_in_time);
            if($date->isSameDay($clockInTime)) {
                return $attendance;
            }
        }

        return null;
    }
}
