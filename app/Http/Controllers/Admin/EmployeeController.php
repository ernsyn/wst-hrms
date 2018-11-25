<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

use Illuminate\Support\Facades\Log;

use Yajra\DataTables\Facades\DataTables;

use App\Country;
use App\Roles;
use App\Bank;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\Team;
use App\EmployeePosition;
use App\Company;

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

    public function display($id)
    {
        $employee = Employee::with('user', 'employee_jobs')->find($id);

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

    public function add()
    {
        $countries = Country::all();
        $roles = Roles::all();

        return view('pages.admin.employees.add', compact('countries','roles'));
    }


    // SECTION: Data Tables

    public function getDataTableDependents($id)
    {
        $dependents = EmployeeDependent::where('emp_id', $id)->get();

        return DataTables::of($dependents)->make(true);
    }

    public function getDataTableImmigrations($id)
    {
        $immigrations = EmployeeImmigration::where('emp_id', $id)->get();

        return DataTables::of($immigrations)->make(true);
    }

    public function getDataTableVisas($id)
    {
        $visa = EmployeeVisa::where('emp_id', $id)->get();
        return DataTables::of($visa)->make(true);
    }

    public function getDataTableBankAccounts($id)
    {
        $banks = EmployeeBankAccount::where('emp_id', $id)->get();
        return DataTables::of($banks)->make(true);
    }

    public function getDataTableJobs($id)
    {
        $job = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', $id)->get();
        return DataTables::of($job)->make(true);
    }

    public function getDataTableExperiences($id)
    {
        $experiences = EmployeeExperience::where('emp_id', $id)->get();
        return DataTables::of($experiences)->make(true);
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
        $reportTos = EmployeeReportTo::with('report_to.user')->where('emp_id', $id)->get();
        return DataTables::of($reportTos)->make(true);
    }

    protected function postAdd(Request $request)
    {
        $validatedUserData = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);
        $validatedUserData['password'] = Hash::make($validatedUserData['password']);


        $validatedEmployeeData = $request->validate([
            'contact_no' => 'required',
            'address' => 'required',
            'company_id' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'race' => 'required',
            'nationality' => '',
            'marital_status' => '',
            'total_children' => '',
            'ic_no' => 'required',
            'tax_no' => 'required',
            'epf_no' => 'required',
            'driver_license_number',
            'driver_license_expiry_date',
        ]);
        // dd($validatedData);

        $user = User::create($validatedUserData);
        $user->assignRole('employee');


        $validatedEmployeeData['user_id'] = $user->id;
        $employee = Employee::create($validatedEmployeeData);

        // $user->employee()->save($employee);

        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);

        // $contact_no = $request->input('contact_no');
        // $address = $request->input('address');
        // $company_id = $request->input('company_id');
        // $dob = $request->input('dob');
        // $gender = $request->input('gender');
        // $race = $request->input('race');
        // $nationality = $request->input('nationality');
        // $marital_status =  $request->input('marital_status');
        // $total_children = $request->input('total_child');
        // $ic_no = $request->input('ic_no');
        // $tax_no = $request->input('tax_no');
        // $epf_no = $request->input('epf_no');
        // $driver_license_no = $request->input('driver_license_number');
        // $driver_license_expiry_date = $request->input('driver_license_expiry_date');
        // $created_by = auth()->user()->id;

        // $user = User::create($input);
        // $user->assignRole('employee');

        // $employee =  new Employee();
        // $employee->user_id = $user->id;
        // $employee->address =$address;
        // $employee->company_id =$company_id;
        // $employee->contact_no =$contact_no;
        // $employee->dob=$dob;
        // $employee->gender =$gender;
        // $employee->race =$race;
        // $employee->nationality=$nationality;

        // $employee->marital_status=$marital_status;
        // $employee->total_children =$total_children;
        // $employee->ic_no =$ic_no;
        // $employee->tax_no=$tax_no;


        // $employee->epf_no=$epf_no;
        // $employee->driver_license_no =$driver_license_no;
        // $employee->driver_license_expiry_date =$driver_license_expiry_date;
        // $employee->created_by=$created_by;
        // // Populate other fields
        // $employee->save();


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

        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);


        $employee = Employee::find($id);
        $employee->employee_emergency_contacts()->save($emergencyContact);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postReportTo(Request $request, $id)
    {
        $reportToData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'kpi_proposer' => 'required',
            'notes' => 'required'
        ]);

        $reportTo = new EmployeeReportTo($reportToData);


        $employee = Employee::find($id);
        $employee->report_tos()->save($reportTo);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postJob(Request $request, $id)
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
            'specification' => 'required',
        ]);
        $jobData['start_date'] = date("Y-m-d", strtotime($jobData['start_date']));
        $jobData['status'] = 'active';

        $job = new EmployeeJob($jobData);

        $employee = Employee::find($id);
        $employee->employee_jobs()->save($job);

        return response()->json(['success'=>'Job is successfully added']);
    }

    public function postDependent(Request $request, $id)
    {
        $dependentData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentData['dob'] = date("Y-m-d", strtotime($dependentData['dob']));

        $dependent = new EmployeeDependent($dependentData);


        $employee = Employee::find($id);
        $employee->dependents()->save($dependent);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postImmigration(Request $request, $id)
    {
        $immigrationData = $request->validate([
            'passport_no' => 'required',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date'
        ]);

        $immigration = new EmployeeImmigration($immigrationData);


        $employee = Employee::find($id);
        $employee->employee_immigrations()->save($immigration);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postVisa(Request $request, $id)
    {
        $visaData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|numeric',
            'passport_no' => 'required|numeric',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'family_members' => 'required'
        ]);

        $visa = new EmployeeVisa($visaData);


        $employee = Employee::find($id);
        $employee->employee_visas()->save($visa);

        return response()->json(['success'=>'Visa is successfully added']);
    }

    public function postBankAccount(Request $request, $id)
    {
        $bankAccountData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required',
            'acc_status' => 'required'
        ]);

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
            'notes' => 'required'
        ]);

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

        $attachment = new EmployeeAttachment($attachmentData);


        $employee = Employee::find($id);
        $employee->employee_attachments()->save($attachment);

        return response()->json(['success'=>'Attachment is successfully added']);
    }

    // SECTION: Edit

    public function postEditDependent(Request $request, $emp_id, $id)
    {
        $name = $request->input('name');
        $relationship = $request->input('relationship');

        EmployeeDependent::where('id', $id)->update(array('name' => $name,'relationship' => $relationship));

        return redirect()->route('admin.employees.id', ['id' => $emp_id]);
    }

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

    public function postEditImmigration(Request $request, $emp_id, $id)
    {
        $immigrationUpdatedData = $request->validate([
            'passport_no' => 'required',
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
            'visa_number' => 'required|numeric',
            'passport_no' => 'required|numeric',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'family_members' => 'required'
        ]);

        EmployeeVisa::where('id', $id)->update($visaUpdatedData);

        return response()->json(['success'=>'Visa was successfully updated.']);
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
            'description' => 'required'
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
            'notes' => 'required'
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
        EmployeeImmigration::find($id)->delete();
        return response()->json(['success'=>'Emergency Contact was successfully deleted.']);
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
    
    public function deleteReportTo(Request $request, $emp_id, $id)
    {
        EmployeeReportTo::find($id)->delete();
        return response()->json(['success'=>'Report To was successfully deleted.']);
    }
    
    public function deleteVisa(Request $request, $emp_id, $id)
    {
        EmployeeVisa::find($id)->delete();
        return response()->json(['success'=>'Visa was successfully deleted.']);
    }

    public function deleteImmigration(Request $request, $emp_id, $id)
    {
        EmployeeImmigration::find($id)->delete();
        return response()->json(['success'=>'Immigration was successfully deleted.']);
    }
    
    public function deleteAttachment(Request $request, $emp_id, $id)
    {
        EmployeeAttachment::find($id)->delete();
        return response()->json(['success'=>'Attachment was successfully deleted.']);
    }
}
