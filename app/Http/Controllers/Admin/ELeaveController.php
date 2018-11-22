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

class ELeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }
   
    
// List Of Leave Public Holidays List
public function displayPublicHolidays()
{       
    $holiday = Holiday::all();
    
    return view('pages.admin.e-leave.configuration.leaveholidays', ['holiday' => $holiday]);
}

public function addPublicHoliday()
{
    return view('pages.admin.e-leave.configuration.add-leaveholidays');
}

public function postAddPublicHoliday(Request $request)
{
    $publicHolidayData = $request->validate([
        'name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        // 'total_days' => 'required',
        'repeat_manually'=>'required',

       //'status' => 'required',
       'note' => 'required',

   
    ]);


    $datetime1 = strtotime($publicHolidayData['start_date']);
    $datetime2 = strtotime($publicHolidayData['end_date']);  
    $created_by = auth()->user()->id;
    $interval =  $datetime2 - $datetime1;
    $days = floor($interval/(60*60*24)) + 1;

    $publicHolidayData['total_days'] =  $days = floor($interval/(60*60*24)) + 1;
   
    $publicHolidayData['status'] =  'active';
   

    Holiday::create($publicHolidayData);

    return redirect()->route('admin.e-leave.configuration.leaveholidays');
}

public function editHoliday(Request $request, $id) {
    $holiday = Holiday::find($id);

    return view('pages.admin.settings.edit-leaveholidays', ['holiday' => $holiday]);
}
public function postEditHoliday(Request $request, $id)
{              
    
    $epfData = $request->validate([
       
        'category' => 'required',
        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',
        'name'=>'required',

    ]);

    EPF::where('id', $id)->update($epfData);
   
    return redirect()->route('admin.settings.epf');
}


// List Of Leave Public Holidays List
public function displayLeaveTypes()
{       
    $types = LeaveType::all();
    
    return view('pages.admin.e-leave.configuration.leavetypes', ['types' => $types]);
}

public function addLeaveType()
{
    return view('pages.admin.e-leave.configuration.add-leavetypes');
}

public function postAddLeaveType(Request $request)
{
    $leaveTypeData = $request->validate([
        'name' => 'required',
        'code' => 'required',
        'name' => 'required',
        'increment_per_year' => 'required',
        'apply_before_days'=>'required',

       'approval_level' => 'required',
       'carry_forward' => 'required',
       'carry_forward_expiry_months'=>'required',
       'divide_method'=>'required',
       'allow_carry_forward'=>'required',
   
    ]);

  
    $leaveTypeData['status'] =  'active';
   

    LeaveType::create($leaveTypeData);

    return redirect()->route('admin.e-leave.configuration.leavetypes');
}

public function editLeaveType(Request $request, $id) {
    $holiday = Holiday::find($id);

    return view('pages.admin.settings.edit-leaveholidays', ['holiday' => $holiday]);
}
public function postEditLeaveType(Request $request, $id)
{              
    
    $epfData = $request->validate([
       
        'category' => 'required',
        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',
        'name'=>'required',

    ]);

    EPF::where('id', $id)->update($epfData);
   
    return redirect()->route('admin.settings.epf');
}


public function displayLeaveRequests()
{       
    $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
    ->join('users','users.id','=','leave_employees_requests.user_id')
    // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
    ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
    ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
    'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
    'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
    'leave_employees_requests.status as status')
    ->get();

    return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
}

// List Of Leave Balances
public function displayLeaveBalances()
{       
 //   $employee = Employee::with('user', 'employee_jobs')->find($id);
    $balances = LeaveBalance::with('leavetypes');
    
    return view('pages.admin.e-leave.configuration.leavebalances', ['balances' => $balances]);
}

public function addLeaveBalance()
{
    return view('pages.admin.e-leave.configuration.add-leavebalances');
}

public function postAddLeaveBalance(Request $request)
{
    $leaveTypeData = $request->validate([
        'name' => 'required',
        'code' => 'required',
        'name' => 'required',
        'increment_per_year' => 'required',
        'apply_before_days'=>'required',

       'approval_level' => 'required',
       'carry_forward' => 'required',
       'carry_forward_expiry_months'=>'required',
       'divide_method'=>'required',
       'allow_carry_forward'=>'required',
   
    ]);

  
    $leaveTypeData['status'] =  'active';
   

    LeaveType::create($leaveTypeData);

    return redirect()->route('pages.admin.e-leave.configuration.leavetypes');
}

public function editLeaveBalance(Request $request, $id) {
    $holiday = Holiday::find($id);

    return view('pages.admin.settings.edit-leaveholidays', ['holiday' => $holiday]);
}
public function postEditLeaveBalance(Request $request, $id)
{              
    
    $epfData = $request->validate([
       
        'category' => 'required',
        'salary' => 'required',
        'employer' => 'required',
        'employee' => 'required',
        'name'=>'required',

    ]);

    EPF::where('id', $id)->update($epfData);
   
    return redirect()->route('admin.settings.epf');
}


























    // public function displayLeaveBalance()
    // {
    //     $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
    //     ->join('users','users.id','=','employees.id')
    //     ->select('users.name as name','users.id as user_id',
    //     'leave_balance.balance as balance','leave_balance.id as balance_id',
    //     'leave_balance.carry_forward as carry',
    //     'leave_types.name as leave','leave_types.id as type_id')
    //     ->get();

    //     $users = User::all();
    //     $types = LeaveType::all();

    //     return view('pages.admin.leave-balance', ['leavebalance'=>$leavebalance,'users'=>$users,'types'=>$types]);        
    // }

    // public function addLeaveBalance(Request $request)
    // {            
    //     $user_id = Input::get('users');
    //     $types = Input::get('types');      
    //     $leave_balance = $request->input('leave_balance');
    //     $carry_forward = $request->input('carry_forward');
    //     $now = Carbon::now();
    //     $created_by = auth()->user()->id;
       
    //     DB::insert('insert into leave_balance
    //     (user_id, id_leave_type, balance,
    //     year, carry_forward, created_by) 
    //     values
    //     (?,?,?,
    //     ?,?,?)',
    //     [$user_id, $types, $leave_balance,
    //     $now->year, $carry_forward, $created_by]);

    //     $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
    //     ->join('users','users.id','=','employees.id')
    //     ->select('users.name as name','users.id as user_id',
    //     'leave_balance.balance as balance','leave_balance.id as balance_id',
    //     'leave_balance.carry_forward as carry',
    //     'leave_types.name as leave','leave_types.id as type_id')
    //     ->get();

    //     $users = User::all();
    //     $types = LeaveType::all();

    //     return view('pages.admin.leave-balance', ['leavebalance'=>$leavebalance,'users'=>$users,'types'=>$types]); 
    // }

    // public function editLeaveBalance(Request $request)
    // {  
    //     $balance_id = $request->input('balance_id');          
    //     $user_id = Input::get('users');
    //     $types = Input::get('types');      
    //     $leave_balance = $request->input('leave_balance');
    //     $carry_forward = $request->input('carry_forward');
       
    //     LeaveBalance::where('id',$balance_id)->update(array('user_id' => $user_id,
    //     'id_leave_type' => $types,'balance' => $leave_balance,'carry_forward' => $carry_forward));


    //     $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
    //     ->join('users','users.id','=','employees.id')
    //     ->select('users.name as name','users.id as user_id',
    //     'leave_balance.balance as balance','leave_balance.id as balance_id',
    //     'leave_balance.carry_forward as carry',
    //     'leave_types.name as leave','leave_types.id as type_id')
    //     ->get();

    //     $users = User::all();
    //     $types = LeaveType::all();

    //     return view('pages.admin.leave-balance', ['leavebalance'=>$leavebalance,'users'=>$users,'types'=>$types]); 
    // }


    // public function displayLeaveHoliday()
    // {    
    //     $leaveholiday = Holiday::all();
    //     return view('pages.admin.leave-holiday', ['leaveholiday'=>$leaveholiday]);
    // }

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
    //     $leaveholiday = Holiday::all();  
    //     return view('pages.admin.leave-holiday', ['leaveholiday'=>$leaveholiday]);
    // }
    
    

    // public function displayLeaveRequest()
    // {       

    //     $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
    //     ->join('users','users.id','=','leave_employees_requests.user_id')
    //     // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
    //     ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
    //     'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
    //     'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
    //     'leave_employees_requests.status as status')
    //     ->get();

    //     return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    // }
    // public function displaySetupJob()
    // {       
    //     $costs = EmployeeCategory::all();
    //     $departments = Department::all();
    //     $teams = Team::all();
    //     $positions = EmployeePosition::all();
    //     $grade = EmployeeGrade::all();
        
    //     return view('pages.admin.settings.job-configure', ['costs'=>$costs, 'departments'=>$departments, 'teams'=>$teams, 'positions'=>$positions, 'grade'=>$grade]);
    // }

  

    // public function displayLeaveTypes()  {
    //     $types = LeaveType::all();
    //     return view('pages.admin.e-leave.configuration.leave-setup', ['types'=>$types]);
    // }

   
    // public function leaveApplication( Request $request)
    // {
    //     $balance = null;
    //     if($request->balance) $balance = $request->balance;
    //     $allRoom =AllocateClassroom::with('course','department')->whereHas('department', function($query) use($department){
    //         if($department) $query->where(id, $department);
    //     })->paginate(10);
    
    //     return view('Admin.allocateClassrooms.index',['allRoom'=>$allRoom, 'department' => $department]);
    
    // }


    // public function approvedLeave()
    // {
    //     $req_id = $_GET['id'];

    //     LeaveRequest::where('id',$req_id)->update(array('status' => 'Approved'));
        

    //     $result = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
    //     ->join('users','users.id','=','leave_employees_requests.user_id')
    //     // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
    //     ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
    //     'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
    //     'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
    //     'leave_employees_requests.status as status')
    //     ->get();

    //     // $test = new TestModel();
    //     // $result = $test->getData($id);

    //     foreach($result as $row)
    //     {
    //         $html =
    //           '<tr>
    //              <td>' . $row->request_id . '</td>' .
    //              '<td>' . $row->name . '</td>' .
    //              '<td>' . $row->leave_type . '</td>' .
    //              '<td>' . $row->start_date . '</td>' .
    //              '<td>' . $row->end_date . '</td>' .
    //              '<td>' . $row->total_days . '</td>' .
    //              '<td>' . $row->status . '</td>' .
    //              '<td></td>' .
    //           '</tr>';
    //     }
    //     return $html;

    //     // return View::make('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    // }

    // public function approvedLeaveRequest(Request $request)
    // {          
       
    //     $req_id = $request->input('req_id');
    //     LeaveRequest::where('id',$req_id)->update(array('status' => 'Approved'));
       
    //     $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
    //     ->join('users','users.id','=','leave_employees_requests.user_id')
    //     // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
    //     ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
    //     'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
    //     'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
    //     'leave_employees_requests.status as status')
    //     ->get();

    //     return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    // }

    // public function disapprovedLeaveRequest(Request $request)
    // {          
       
    //     $req_id = $request->input('req_id');
    //     LeaveRequest::where('id',$req_id)->update(array('status' => 'Disapproved'));
       
    //     $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
    //     ->join('users','users.id','=','leave_employees_requests.user_id')
    //     // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
    //     ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
    //     ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
    //     'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
    //     'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
    //     'leave_employees_requests.status as status')
    //     ->get();

    //     return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    // }

    // public function displayLeaveApplication()
    // {      
    //     $leave = LeaveBalance::join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
    //     ->select('leave_types.id','leave_types.name','leave_balance.balance')
    //     ->where('leave_balance.user_id', Auth::user()->id)
    //     ->get();

    //     //$types = LeaveType::all();

    //     return view('pages.leaveapplication', ['leave'=>$leave]);
    // }
    public function approvedLeaveRequest(Request $request)
    {         
        $req_id = $request->input('req_id');
        LeaveRequest::where('id',$req_id)->update(array('status' => 'Approved'));
       
        $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
        ->join('users','users.id','=','leave_employees_requests.user_id')
        // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
        ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
        ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
        'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
        'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
        'leave_employees_requests.status as status')
        ->get();

        return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    }

    public function disapprovedLeaveRequest(Request $request)
    {          
       
        $req_id = $request->input('req_id');
        LeaveRequest::where('id',$req_id)->update(array('status' => 'Disapproved'));
       
        $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
        ->join('users','users.id','=','leave_employees_requests.user_id')
        // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
        ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
        ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
        'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
        'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
        'leave_employees_requests.status as status')
        ->get();

        return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
    }

}
