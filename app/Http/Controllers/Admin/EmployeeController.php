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

        $bank_list = Bank::all();
        $cost_centre = CostCentre::all();
        $department = Department::all();
        $team = Team::all();
        $position = EmployeePosition::all();
        $grade = EmployeeGrade::all();
        $branch = Branch::all();
        $countries = Country::all();
        $companies = Company::all();

        return view('pages.admin.employees.id', ['employee' => $employee,'countries'=>$countries, 'team'=>$team,'bank_list'=>$bank_list,'branch'=>$branch, 'grade'=>$grade,'department'=>$department, 'position'=>$position,'companies'=>$companies,'cost_centre'=>$cost_centre]);        
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

        foreach ($dependents as $dependent) {
            $dependent->update_url = route('admin.employees.dependents.edit', ['emp_id' => $id, 'id' => $dependent->id]);
        }

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
        $job = EmployeeJob::where('emp_id', $id)->get();
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

    public function postDependent(Request $request, $id)
    {              
        $name = $request->input('name');
        $relationship = $request->input('relationship');      
        $altDobDate = $request->input('altdobDate');
        $created_by = auth()->user()->id;

         
        DB::insert('insert into employee_dependents
        (emp_id, name, relationship, dob, created_by) 
        values
        (?,?,?,?,?)',
        [$id, $name, $relationship, $altDobDate, $created_by]);

        // $dependents = EmployeeDependent::where('emp_id', $id)->get();  
        
        return redirect()->route('admin.employees.id', ['id' => $id]); 
    }

    public function postImmigration(Request $request, $id)
    {           
        $passport_no = $request->input('passport_no'); 
        $issued_by = $request->input('issued_by');     
        $altexpiryDate = $request->input('altexpiryDate');
        $altlicenseExpiryDate = $request->input('altlicenseExpiryDate');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_immigrations
        (emp_id, passport_no, issued_by, issued_date, expiry_date, created_by) 
        values
        (?,?,?,?,?,?)',
        [$id, $passport_no, $issued_by, $altexpiryDate, $altlicenseExpiryDate, $created_by]);


        // $immigrations = EmployeeImmigration::where('emp_id',$user_id)->get();  

        return redirect()->route('admin.employees.id', ['id' => $id]);  
    }

    public function postVisa(Request $request, $id)
    {
        $family_members = $request->input('family_members'); 
        $visa_number = $request->input('visa_number');     
        $issued_date = $request->input('issued_date');
        $expiry_date = $request->input('expiry_date');        
        $issued = $request->input('altissueDate');
        $expiry = $request->input('altexpDate');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_visas
        (emp_id, visa_number,family_members, issued_date, expiry_date, created_by) 
        values
        (?,?,?,?,?,?)',
         [$id, $visa_number,$family_members, $issued, $expiry, $created_by]);
        
         return redirect()->route('admin.employees.id', ['id' => $id]); 
    }

    public function postBankAccount(Request $request, $id)
    {          
        $type = $request->input('type');             
        $bank_code = Input::get('bank_list');
        $acc_no = $request->input('acc_no'); 
        $status = Input::get('status');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_bank_accounts
        (emp_id, type, bank_code, acc_no, acc_status, created_by) 
        values
        (?,?,?,?,?,?)',
        [$id, $type, $bank_code, $acc_no, $status, $created_by]);

        return redirect()->route('admin.employees.id', ['id' => $id]); 
    }

    public function postCompany(Request $request, $id)
    {          
        $company = $request->input('company');
        $position = $request->input('position');      
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');   
        $note = $request->input('notes');   
        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_experience
        (emp_id, previous_company, previous_position, start_date, end_date, note, created_by) 
        values
        (?,?,?,?,?,?,?)',
        [$id, $company, $position, $start_date, $end_date, $note, $created_by]);

        return redirect()->route('admin.employees.id', ['id' => $id]);  
    }

    public function postEducation(Request $request, $id)
    {          
        $level = $request->input('level');
        $major = $request->input('major');      
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');   
        $gpa = $request->input('gpa');
        $school = $request->input('school');
        $description = $request->input('description');                
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_education
        (emp_id, level, major, start_year, end_year, gpa, school, description, created_by) 
        values
        (?,?,?,?,?,?,?,?,?)',
        [$id, $level, $major, $start_year, $end_year, $gpa, $school, $description, $created_by]);

        return redirect()->route('admin.employees.id', ['id' => $id]); 
    }

    public function postSkill(Request $request, $id)
    {          
        $emp_skill = $request->input('skills');
        $year_experience = $request->input('year_experience');      
        $competency = Input::get('competency');            
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_skills
        (emp_id, emp_skill, year_experience, competency, created_by) 
        values
        (?,?,?,?,?)',
        [$id, $emp_skill, $year_experience, $competency, $created_by]);

        return redirect()->route('admin.employees.id', ['id' => $id]); 
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
        $name = $request->input('name');
        $relationship = $request->input('relationship');    
        $contact_number = $request->input('contact_number');       
       
        EmergencyContact::where('id', $id)->update(array('contact_name' => $name,'relationship' => $relationship, 'contact_number' => $contact_number));

        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditImmigration(Request $request, $emp_id, $id)
    {          
        $document = $request->input('document');
        $passport_no = $request->input('passport_no');    
        $issued_by = $request->input('issued_by');       
       
        EmployeeImmigration::where('id', $id)->update(array('document' => $document,'passport_no' => $passport_no, 'issued_by' => $issued_by));

        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditVisa(Request $request, $emp_id, $id)
    {    
        $type = $request->input('type');    
        $visa_number = $request->input('visa_number');
        $family_members = $request->input('family_members');    
       
        EmployeeVisa::where('id', $id)->update(array('type' => $type, 'visa_number' => $visa_number,'family_members' => $family_members));
         
        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditBankAccount(Request $request, $emp_id, $id)
    {          
        $bank_code = Input::get('bank_code');
        $acc_no = $request->input('acc_no'); 
        $acc_status = Input::get('acc_status');      
       
        EmployeeBank::where('id', $id)->update(array(
            'bank_code' => $bank_code,
            'acc_no' => $acc_no,
            'acc_status' => $acc_status
        ));

        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditCompany(Request $request, $emp_id, $id)
    {          
        $previous_company = $request->input('previous_company');
        $previous_position = $request->input('previous_position');      
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');   
        $note = $request->input('note');           

        EmployeeExperience::where('id', $id)->update(array(
            'previous_company' => $previous_company,
            'previous_position' => $previous_position,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'note' => $note
        ));
        
        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditEducation(Request $request, $emp_id, $id)
    {          
        $level = $request->input('level');
        $major = $request->input('major');      
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');   
        $gpa = $request->input('gpa');
        $school = $request->input('school');
        $description = $request->input('description');   

        EmployeeEducation::where('id', $id)->update(array(
            'level' => $level,
            'major' => $major,
            'start_year' => $start_year,
            'end_year' => $end_year,
            'gpa' => $gpa,
            'school' => $school,
            'description' => $description
        ));
       
        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }

    public function postEditSkill(Request $request, $emp_id, $id)
    {               
        $emp_skill = $request->input('emp_skill');
        $year_experience = $request->input('year_experience');      
        $competency = Input::get('competency');   
       
        EmployeeSkills::where('id',$skill_id)->update(
            array('emp_skill' => $emp_skill,
            'year_experience' => $year_experience,
            'competency' => $competency));

        return redirect()->route('admin/employees/{id}', ['id' => $emp_id]);
    }
}
