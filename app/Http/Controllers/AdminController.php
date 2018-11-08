<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeAttachment;
use App\EmployeeBankAccount;
use App\EmployeeDependent;
use App\EmployeeEducation;
use App\EmployeeEmergencyContact;
use App\Experience;
use App\EmployeeGrade;
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

use DB;
use App\User;
use App\EmployeeInfo;
use \Crypt;
use Session;
use Illuminate\Support\Facades\Input;
use \DateTime;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function displaySetupCompany()
    {       
      
        $company = Company::select('companies.name as name','companies.description as description',
        'companies.logo_media_id as image','companies.tax_no as tax_no',
        'companies.epf_no as epf_no',
        'companies.socso_no as socso_no','companies.eis_no as eis_no',
        'companies.updated_at as updated_at',
        'companies.status as status')
        ->get();

        return view('pages.admin.setup.company', ['company'=>$company]);
    }

    public function displayAddCompany()
    {
        return view('pages.admin.setup.add-company');
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
        
       
        DB::insert('insert into companies
        (code, name, url, registration_no,
        description, address, phone,
        tax_no, epf_no, socso_no,
        eis_no, status, created_by,
        updated_by,gst_no) 
        values
        (?,?,?,?,
        ?,?,?,
        ?,?,?,
        ?,?,?,
        ?,?)',
        [$code, $name, $url, $registration_no,
        $description, $address, $phone,
        $tax_no, $epf_no, $socso_no,
        $eis_no,'Active', $created_by,
        $created_by,'none']);

        $company = Company::join('employees','employees.id','=','companies.updated_by')
        ->join('users','users.id','=','employees.id')
        ->select('companies.name as name','companies.description as description','companies.logo_media_id as image','companies.tax_no as tax_number',
        'companies.epf_no as epf_number','companies.socso_no as socso_number','companies.eis_no as eis_number',
        'companies.updated_at as updated_on','users.name as EmpName','companies.status as status')
        ->get();

        return view('pages.admin.setup.company', ['company'=>$company]);
    }

    public function displayEmployeeLeave()
    {       
        $leavetype = LeaveType::all();
        return view('pages.admin.leave-setup', ['leavetype'=>$leavetype]);
    }

    public function displayLeaveBalance()
    {
         $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
        ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
        ->join('users','users.id','=','employees.id')
        ->select('users.name as name',
        'leave_balance.balance as balance',
        'leave_balance.carry_forward as carry',
        'leave_types.name as leave')
        ->get();
        return view('pages.admin.leave-balance', ['leavebalance'=>$leavebalance]);

        
    }
    public function displayLeaveHoliday()
    {    
        $leaveholiday = Holiday::all();
        return view('pages.admin.leave-holiday', ['leaveholiday'=>$leaveholiday]);

        
    }

    public function addHoliday(Request $request)
    {            
        $name = $request->input('name');
        $startDate = $request->input('startDate');      
        $endDate = $request->input('endDate');
        $datetime1 = strtotime($startDate);
        $datetime2 = strtotime($endDate);     
        $created_by = auth()->user()->id;
        $interval =  $datetime2 - $datetime1;
        $days = floor($interval/(60*60*24)) + 1;
        DB::insert('insert into holidays
        (name,start_date,end_date, created_by,total_days) 
        values
        (?,?,?,?,?)',
        [$name, $startDate,$endDate, $created_by,$days]);
        $leaveholiday = Holiday::all();  
        return view('pages.admin.leave-holiday', ['leaveholiday'=>$leaveholiday]);
    }
    
    

    public function displayLeaveRequest()
    {       

        $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
        ->join('users','users.id','=','leave_employees_requests.user_id')
        ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
        ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
        ->select('leave_employees_requests.start_date as start_date',
        'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
        'users.name as name','leave_employees_requests.user_id as emp','employee_jobs.department_id as department',
        'leave_employees_requests.status as status')
        ->get();

        return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    }
    public function displaySetupJob()
    {       
        $costs = EmployeeCategory::all();
        $departments = Department::all();
        $teams = Team::all();
        $positions = EmployeePosition::all();
        $grade = EmployeeGrade::all();
        
        return view('pages.admin.setup.job-configure', ['costs'=>$costs, 'departments'=>$departments, 'teams'=>$teams, 'positions'=>$positions, 'grade'=>$grade]);
    }

    public function displaySetupBranch()
    {       
        $branch = Branch::all();
        
        return view('pages.admin.setup.branch', ['branch'=>$branch]);
    }

    public function displayEmergencyContact()
    {
        $id = Session::get('user_id');

        $user = Employee::where('user_id', $id)->first();
        $contacts = EmployeeEmergencyContact::where('emp_id',$user->id)->get();

        // return view('pages.admin.emergency-contact', ['contacts'=>$contacts->sortByDesc('id')]);
        return DataTables::of($contacts)->make(true);
    }

    // public function displayEmployeeEmergencyContact()
    // {
    //     $id = Session::get('user_id');

    //     $contacts = EmployeeEmergencyContact::where('emp_id',$id)->get();
    //     // return view('pages.admin.emergency-contact', ['contacts'=>$contacts->sortByDesc('id')]);
    //     return DataTables::of($contacts)->make(true);
    // }

    public function addEmergencyContact(Request $request)
    {          
        $user_id = Session::get('user_id');

        $user = Employee::where('user_id', $user_id)->first();
      
        $name = $request->input('name');
        $relationship = $request->input('relationship');       
        $contact_number = $request->input('contact_number');
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_emergency_contacts
        (emp_id, name, relationship, contact_no, created_by) 
        values
        (?,?,?,?,?)',
        [$user->id, $name, $relationship, $contact_number, $created_by]);

        // $contacts = EmployeeEmergencyContact::where('emp_id',$emp_id)->get();  

        // return view('pages.admin.emergency-contact', ['contacts'=>$contacts->sortByDesc('id')]);

        $user = User::join('employees','employees.user_id','=','users.id')
        ->join('countries','countries.id','=','employees.nationality')
        ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        // $user = Employee::join('users','employees.user_id','=','users.id')
        // ->join('countries','countries.country_code','=','employees.nationality')
        // ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        ->select('users.name as name','users.email as email', 
        'employees.contact_no as contact_no', 'employees.address as address', 
        'employees.ic_no as ic_no', 'employees.gender as gender', 
        'employees.dob as dob','employees.marital_status as marital_status',
        'employees.race as race', 'employees.total_children as total_child', 
        'employees.driver_license_no as driver_license_no', 
        'employees.driver_license_expiry_date as _license_expiry_date',
        'users.id as user_id','employees.epf_no as epf_no',
        'employees.tax_no as tax_no ','employees.basic_salary as basic_salary')
        ->where('users.id',$user_id)
        ->first();

        return view('pages.admin.profile-employee',['user'=>$user]); 
    }

    public function editEmergencyContact(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $emp_con_id = $request->input('emp_con_id');
        $name = $request->input('name');
        $relationship = $request->input('relationship');    
        $contact_number = $request->input('contact_number');       
       
        EmergencyContact::where('id',$emp_con_id)->update(array('contact_name' => $name,'relationship' => $relationship, 'contact_number' => $contact_number));
        $contacts = EmergencyContact::where('emp_id',$emp_id)->get();  
        return view('pages.admin.emergency-contact', ['contacts'=>$contacts->sortByDesc('id')]);
    }

    public function displayEmployeeDependent()
    {       
        $id = Session::get('employee_id');

        $dependents = EmployeeDependent::where('emp_id',$id)->get();
        return view('pages.admin.employee-dependent', ['dependents'=>$dependents->sortByDesc('id')]);
    }

    public function addEmployeeDependent(Request $request)
    {          
        $emp_id = Session::get('employee_id');        
        $name = $request->input('name');
        $relationship = $request->input('relationship');      
        $time = $request->input('altdobDate');
        $created_by = auth()->user()->id;

        echo '<script>';
        echo 'console.log('. $date_of_birth  .')';
        echo '</script>';
       
        DB::insert('insert into employee_dependent
        (emp_id, dependent_name, dependent_relationship, date_of_birth, created_by) 
        values
        (?,?,?,?,?)',
        [$emp_id, $name, $relationship, $time, $created_by]);

        $dependents = EmployeeDependent::where('emp_id',$emp_id)->get();  
        return view('pages.admin.employee-dependent', ['dependents'=>$dependents->sortByDesc('id')]);
    }

    // public function addHoliday(Request $request)
    // {            
    //     $name = $request->input('name');
    //     $startDate = $request->input('startDate');      
    //     $endDate = $request->input('endDate');
    //     $datetime1 = strtotime($startDate);
    //     $datetime2 = strtotime($endDate);     
    //     $created_by = auth()->user()->id;
    //     $interval =  $datetime2 - $datetime1;
    //     $days = floor($interval/(60*60*24)) + 1;
    //     DB::insert('insert into holidays
    //     (name,start_date,end_date, created_by,total_days) 
    //     values
    //     (?,?,?,?,?)',
    //     [$name, $startDate,$endDate, $created_by,$days]);
    //     $leaveholiday = leaveHoliday::all();  
    //     return view('pages.admin.leave-holiday', ['leaveholiday'=>$leaveholiday]);
    // }

    public function editEmployeeDependent(Request $request)
    {          
        $emp_id = Session::get('employee_id');
        $emp_dep_id = $request->input('emp_dep_id');
        $name = $request->input('name');
        $relationship = $request->input('relationship');       
        //$date_of_birth = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dobDate'))));
       
        EmployeeDependent::where('id',$emp_dep_id)->update(array('dependent_name' => $name,'dependent_relationship' => $relationship));

        $dependents = EmployeeDependent::where('emp_id',$emp_id)->get();  
        return view('pages.admin.employee-dependent', ['dependents'=>$dependents->sortByDesc('id')]);
    }

    public function displayEmployeeImmigration()
    {       
        $id = Session::get('employee_id');

        $immigrations = EmployeeImmigration::where('emp_id',$id)->orderBy('id', 'DESC')->get();
        return view('pages.admin.employee-immigration', ['immigrations'=>$immigrations]);
    }

    public function addEmployeeImmigration(Request $request)
    {          
        $emp_id = Session::get('employee_id');;        
        $document = $request->input('document');
        $passport_no = $request->input('passport_no'); 
        $issued_by = $request->input('issued_by');     
        $issued_date = $request->input('issued_date');
        $expiry_date = $request->input('expiry_date');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_immigration
        (emp_id, document, passport_no, issued_by, issued_date, expiry_date, created_by) 
        values
        (?,?,?,?,?,?,?)',
        [$emp_id, $document, $passport_no, $issued_by, $issued_date, $expiry_date, $created_by]);


        $immigrations = EmployeeImmigration::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();  
        return view('pages.admin.employee-immigration', ['immigrations'=>$immigrations]);
    }

    public function editEmployeeImmigration(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $img_id = $request->input('img_id');
        $document = $request->input('document');
        $passport_no = $request->input('passport_no');    
        $issued_by = $request->input('issued_by');       
       
        EmployeeImmigration::where('id',$img_id)->update(array('document' => $document,'passport_no' => $passport_no, 'issued_by' => $issued_by));
        $immigrations = EmployeeImmigration::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();  
        return view('pages.admin.employee-immigration', ['immigrations'=>$immigrations]);
    }

    public function displayEmployeeVisa()
    {       
        $id = Session::get('employee_id');

        $visa = EmployeeVisa::where('emp_id',$id)->orderBy('id', 'DESC')->get();
        return view('pages.admin.employee-visa', ['visa'=>$visa]);
    }

    public function displayLeaveTypeList(){

        $typeList=LeaveType::all;
        return view('leavelist',compact('typelist'));
    }

    public function leaveApplication( Request $request)
    {
        $balance = null;
        if($request->balance) $balance = $request->balance;
        $allRoom =AllocateClassroom::with('course','department')->whereHas('department', function($query) use($department){
            if($department) $query->where(id, $department);
        })->paginate(10);
    
        return view('Admin.allocateClassrooms.index',['allRoom'=>$allRoom, 'department' => $department]);
    
    }

    public function addEmployeeVisa(Request $request)
    {          
        $emp_id = Session::get('employee_id');
        $family_members = $request->input('family_members'); 
        $visa_number = $request->input('visa_number');     
        $issued_date = $request->input('issued_date');
        $expiry_date = $request->input('expiry_date');        
        $issued = $request->input('issued_date');
        $expiry = $request->input('expiry_date');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_visa
        (emp_id, visa_number,family_members, issued_date, expiry_date, created_by) 
        values
        (?,?,?,?,?,?)',
        [$emp_id, $visa_number,$family_members, $issued_date, $expiry_date, $created_by]);


        $visa = EmployeeVisa::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();  
        echo '<script>console.log('.$issued_date.')</script>';
        echo '<script>console.log('.$expiry_date.')</script>';
        echo '<script>console.log('.$issued.')</script>';
        echo '<script>console.log('.$expiry.')</script>';
        
        return view('pages.admin.employee-visa', ['visa'=>$visa]); 
    }

    public function editEmployeeVisa(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $visa_id = $request->input('visa_id');
        $type = $request->input('type');    
        $visa_number = $request->input('visa_number');
        $family_members = $request->input('family_members');    
       
        EmployeeVisa::where('id',$visa_id)->update(array('type' => $type, 'visa_number' => $visa_number,'family_members' => $family_members));
        $visa = EmployeeVisa::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();  
        return view('pages.admin.employee-visa', ['visa'=>$visa]); 
    }

    public function displayEmployeeBank()
    {       
        $id = Session::get('employee_id');

        $banks = EmployeeBank::where('emp_id',$id)->orderBy('id', 'DESC')->get();
        $bank_list = BankCode::all();        
        
        return view('pages.admin.employee-bank', ['banks'=>$banks,'bank_list'=>$bank_list]);
    }

    public function addEmployeeBank(Request $request)
    {          
        $emp_id = Session::get('employee_id');    
        $type = $request->input('type');             
        $bank_code = Input::get('bank_list');
        $acc_no = $request->input('acc_no'); 
        $status = Input::get('status');        
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_bank
        (emp_id, type, bank_code, acc_no, acc_status, created_by) 
        values
        (?,?,?,?,?,?)',
        [$emp_id, $type, $bank_code, $acc_no, $status, $created_by]);

        $banks = EmployeeBank::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();
        $bank_list = BankCode::all();        
        
        return view('pages.admin.employee-bank', ['banks'=>$banks,'bank_list'=>$bank_list]);
    }

    public function editEmployeeBank(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $bank_id = $request->input('bank_id');
        $bank_code = Input::get('bank_code');
        $acc_no = $request->input('acc_no'); 
        $acc_status = Input::get('acc_status');      
       
        EmployeeBank::where('id',$bank_id)->update(array('bank_code' => $bank_code,
        'acc_no' => $acc_no,'acc_status' => $acc_status,));
        $banks = EmployeeBank::where('emp_id',$emp_id)->orderBy('id', 'DESC')->get();
        $bank_list = BankCode::all();        
        
        return view('pages.admin.employee-bank', ['banks'=>$banks,'bank_list'=>$bank_list]); 
    }
    
    public function displayProfile()
    {
        
        $user = Employee::join('users','users.emp_id','=','employees.id')
        ->join('countries','countries.id','=','employee.citizenship')
        ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        //->join('employee_grade','employee_jobs.id_grade','=','employee_grade.id')
        ->select('employee.name','users.email', 'employees.contact_no', 'employees.address', 'employees.ic_no', 'employees.gender', 'employees.dob',
        'employees.marital_status', 'employees.race', 'employees.total_child', 'employees.driver_license_number', 'employees.license_expiry_date','users.emp_id',
        'employees.epf_no','employees.tax_no','employees.basic_salary','countries.citizenship')
        ->where('users.id', auth()->user()->id)
        ->first();
        return view('home')->with('user',$user);
        
    }

    public function displayAllEmployee()
    {
        $employees = EmployeeJob::leftjoin('employees','employees.id','=','employee_jobs.emp_id')
        ->join('users','users.id','=','employees.user_id')
        ->join('cost_centres','cost_centres.id','=','employee_jobs.cost_centre_id')
        ->join('departments','departments.id','=','employee_jobs.department_id')
        ->join('employee_positions','employee_positions.id','=','employee_jobs.emp_mainposition_id')  
        ->select('employee_jobs.emp_id','employees.user_id as user_id', 'users.name as name', 'cost_centres.name as cost_centre', 'departments.name as department_name',
        'employee_positions.name as position_name', 'employee_jobs.start_date')    
        ->get();

        return view('pages.admin.all-employee')->with('employees',$employees);
    }

    public function displayProfile2($id)
    {
        Session::put('user_id', $id);

        $user = User::join('employees','employees.user_id','=','users.id')
        ->join('countries','countries.id','=','employees.nationality')
        ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        // $user = Employee::join('users','employees.user_id','=','users.id')
        // ->join('countries','countries.country_code','=','employees.nationality')
        // ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        ->select('users.name as name','users.email as email', 
        'employees.contact_no as contact_no', 'employees.address as address', 
        'employees.ic_no as ic_no', 'employees.gender as gender', 
        'employees.dob as dob','employees.marital_status as marital_status',
        'employees.race as race', 'employees.total_children as total_child', 
        'employees.driver_license_no as driver_license_no', 
        'employees.driver_license_expiry_date as _license_expiry_date',
        'users.id as user_id','employees.epf_no as epf_no',
        'employees.tax_no as tax_no ','employees.basic_salary as basic_salary')
        ->where('users.id',$id)
        ->first();


        return view('pages.admin.profile-employee',['user'=>$user]);        
    }

    public function displayQualification()
    {
        $emp_id = Session::get('employee_id');                
        
        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function addQualificationCompany(Request $request)
    {          
        $emp_id = Session::get('employee_id');

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
        [$emp_id, $company, $position, $start_date, $end_date, $note, $created_by]);

        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function addQualificationEducation(Request $request)
    {          
        $emp_id = Session::get('employee_id');

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
        [$emp_id, $level, $major, $start_year, $end_year, $gpa, $school, $description, $created_by]);

        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function addQualificationSkills(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $emp_skill = $request->input('skills');
        $year_experience = $request->input('year_experience');      
        $competency = Input::get('competency');            
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_skills
        (emp_id, emp_skill, year_experience, competency, created_by) 
        values
        (?,?,?,?,?)',
        [$emp_id, $emp_skill, $year_experience, $competency, $created_by]);

        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function editQualificationCompany(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $comp_id = $request->input('comp_id');
        $previous_company = $request->input('previous_company');
        $previous_position = $request->input('previous_position');      
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');   
        $note = $request->input('note');           
        $created_by = auth()->user()->id;

        EmployeeExperience::where('id',$comp_id)->update(array('previous_company' => $previous_company,
        'previous_position' => $previous_position,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'note' => $note));
       
        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function editQualificationEducation(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $edu_id = $request->input('edu_id');
        $level = $request->input('level');
        $major = $request->input('major');      
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');   
        $gpa = $request->input('gpa');
        $school = $request->input('school');
        $description = $request->input('description');   

        EmployeeEducation::where('id',$edu_id)->update(
        array('level' => $level,
        'major' => $major,
        'start_year' => $start_year,
        'end_year' => $end_year,
        'gpa' => $gpa,
        'school' => $school,
        'description' => $description));
       
        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function editQualificationSkills(Request $request)
    {          
        $emp_id = Session::get('employee_id');

        $skill_id = $request->input('skill_id');        
        $emp_skill = $request->input('emp_skill');
        $year_experience = $request->input('year_experience');      
        $competency = Input::get('competency');   
       
        EmployeeSkills::where('id',$skill_id)->update(
            array('emp_skill' => $emp_skill,
            'year_experience' => $year_experience,
            'competency' => $competency));

        $companies = EmployeeExperience::where('emp_id', $emp_id)->get();
        $educations = EmployeeEducation::where('emp_id', $emp_id)->get();
        $skills = EmployeeSkills::where('emp_id', $emp_id)->get();
        
        return view('pages.admin.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
    }

    public function displayReportTo()
    {       
        $id = Session::get('employee_id');

        $employees = EmployeeInfo::all();       

        $reports = EmployeeReportTo::join('employee','employee.emp_id','=','employee_report_to.report_id_emp_master')
        ->select('employee.name','employee_report_to.type', 'employee_report_to.note', 'employee_report_to.kpi_proposer')
        ->where('employee_report_to.emp_id', $id)
        ->get();

        return view('pages.admin.report-to', ['reports'=>$reports->sortByDesc('id'), 'employees'=>$employees]);
    }

    public function addReportTo(Request $request)
    {          
        $emp_id = Session::get('employee_id');    

        $report_to_id = Input::get('employees');             
        $type = Input::get('type');        
        $kpi_proposer = Input::get('kpi_proposer');      
        $note = $request->input('note');   
        $created_by = auth()->user()->id;
       
        DB::insert('insert into employee_report_to
        (emp_id, report_id_emp_master, type, kpi_proposer, note, created_by) 
        values
        (?,?,?,?,?,?)',
        [$emp_id, $report_to_id, $type, $kpi_proposer, $note, $created_by]);

        $employees = EmployeeInfo::all();       

        $reports = EmployeeReportTo::join('employee','employee.emp_id','=','employee_report_to.report_id_emp_master')
        ->select('employee.name','employee_report_to.type', 'employee_report_to.note', 'employee_report_to.kpi_proposer')
        ->where('employee_report_to.emp_id', $emp_id)
        ->get();

        return view('pages.admin.report-to', ['reports'=>$reports->sortByDesc('id'), 'employees'=>$employees]);
    }

    public function displayHistory()
    {       
        $emp_id = Session::get('employee_id');    
        
        $history = EventLog::join('employee','employee.emp_id','=','event_log.created_by')
        ->select('employee.name','event_log.type','event_log.note','event_log.created_on')
        ->where('event_log.emp_id', $emp_id)
        ->get();
        return view('pages.admin.history', ['history'=>$history]);
    }

    public function displayCostCentre()
    {
        $costs = CostCentre::all();
        return view('pages.admin.setup.cost-centre', ['costs'=>$costs]);
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
        return view('pages.admin.setup.cost-centre', ['costs'=>$costs]);
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
        return view('pages.admin.setup.cost-centre', ['costs'=>$costs]);
    }

    public function displayDepartment()
    {
        $departments = Department::all();
        return view('pages.admin.setup.department', ['departments'=>$departments]);
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
        return view('pages.admin.setup.department', ['departments'=>$departments]);
    }

    public function displayTeam()
    {
        $team = Team::all();
        return view('pages.admin.setup.team', ['team'=>$team]);
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
        return view('pages.admin.setup.team', ['team'=>$team]);
    }

    public function displayPosition()
    {
        $positions = EmployeePosition::all();
        return view('pages.admin.setup.position', ['positions'=>$positions]);
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
        return view('pages.admin.setup.position', ['positions'=>$positions]);
    }

    public function displayGrade()
    {
        $grade = EmployeeGrade::all();
        return view('pages.admin.setup.grade', ['grade'=>$grade]);
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
        return view('pages.admin.setup.grade', ['grade'=>$grade]);
    }


}
