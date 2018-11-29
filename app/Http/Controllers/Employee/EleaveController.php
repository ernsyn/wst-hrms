<?php

namespace App\Http\Controllers\Employee;
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
use App\EmployeeReportTo;
use App\Country;
use App\Employee;
use App\Holiday;
use App\CompanyBank;
use App\SecurityGroup;
use App\Addition;
use App\Deduction;
use App\Bank;
use App\EaForm;

use App\LeaveAllocation;
use App\LTAppliedRule;
use DatePeriod;
use DateInterval;

use DB;
use App\User;
use App\EmployeeInfo;
use \Crypt;
use Session;
use Illuminate\Support\Facades\Input;
use \DateTime;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Auth;

use App\Http\Services\LeaveService;

class ELeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);

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


    public function displayLeaveRequestReportTo()
    {
        $user = Auth::user();
    
        $report_to_emp_id = $user->employee->id;
     $report_to = EmployeeReportTo::where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

    $leaveRequests =LeaveRequest::with('leave_types')->whereIn('emp_id',$report_to)->get();

// dd($leaverequest);

        return view('pages.employee.leave.leave-request', ['leaveRequests' => $leaveRequests]);


        
    }
  
        public function displayProfile()
        {
           $user = Auth::user();
           
            $userEmail = $user->id;
            
            $user = Employee::join('users','users.id','=','employees.user_id')
            //   ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
            //->join('employee_grade','employee_jobs.id_grade','=','employee_grade.id')
            ->select('users.name as name','users.email as email', 'employees.contact_no as contact_no', 'employees.address', 
            'employees.ic_no', 'employees.gender', 'employees.dob',
            'employees.marital_status', 'employees.race', 'employees.total_children as total_child', 
            'employees.driver_license_no as driver_license_number', 'employees.driver_license_expiry_date as license_expiry_date',
            'employees.epf_no','employees.tax_no','employees.basic_salary')
            ->where('users.id',$userEmail)
            ->first();
      
    
            return view('pages.employee.profile')->with('user',$user);
        }
    
    
        public function displayJob()
        {       
            $data = EmployeeJob::join('departments','employee_jobs.department_id','=','departments.id')
            ->join('employee_positions','employee_jobs.emp_mainposition_id','=','employee_positions.id')
            ->join('teams','employee_jobs.team_id','=','teams.id')
            ->join('employee_grades','employee_jobs.emp_grade_id','=','employee_grades.id')
            ->join('cost_centres','employee_jobs.cost_centre_id','=','cost_centres.id')
            ->select('employee_jobs.created_by','employee_positions.name AS positionname','departments.name AS departname','teams.name AS teamname','cost_centres.name AS categoryname','employee_grades.name AS gradename','employee_jobs.basic_salary','employee_jobs.status')
            ->where('emp_id', auth()->user()->id)
            ->get();
           
            $jobs = json_decode($data, true);
    
            // return view('pages.employee.job', ['jobs'=>$jobs]);
            return DataTables::of($jobs)->make(true);
        }
    
        public function displayReportTo()
        {
            $data = EmployeeReportTo::join('employees','employees.emp_id','=','employee_report_to.report_id_emp_master')
            ->select('employees.name','employee_report_to.type','employee_report_to.note','employee_report_to.kpi_proposer')
            ->where('employee_report_to.emp_id', auth()->user()->id)
            ->get();
    
            $reports = json_decode($data, true);
    
            // return view('pages.employee.report-to', ['reports'=>$reports]);
            return DataTables::of($reports)->make(true);
        }
    
        public function displayHistory()
        {       
            $history = EventLog::join('employees','employees.emp_id','=','event_log.created_by')
            ->select('employees.name','event_log.type','event_log.note','event_log.created_on')
            ->where('event_log.emp_id', auth()->user()->id)
            ->get();
            // return view('pages.employee.history', ['history'=>$history]);
            return DataTables::of($history)->make(true);
        }
    
        public function displayAttachment()
        {       
            $attachments = EmployeeAttachment::where('emp_id', auth()->user()->id)->get();
            // return view('pages.employee.attachment', ['attachments'=>$attachments]);
            return DataTables::of($attachments)->make(true);
        }
    
        //------ for features purposes ------------
        public function find($emp_id)
        {
            $query = EmergencyCOntact::query();
    
            if($id){
                $result = $query->where('id',$id)->first();
            }else{
                $result = $query->where('emp_id', $emp_id)->get();
            }
    
            return $result;
        }
    
        public function displayLeaveApplication()
        {      
            // $leavebalance = LeaveBalance::join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
            // ->select('leave_types.id as id', 'leave_types.name as name','leave_balance.balance as balance')
            // ->where('leave_balance.user_id', Auth::user()->id) 
            
            // ->get();
    
            $leavebalance = LeaveType::all();
    
            return view('pages.employee.leave.leave-application', ['leavebalance'=>$leavebalance]);
        }

        public function ajaxGetLeaveTypes()
        {
            $leaveTypes = LeaveService::getLeaveTypesForEmployee(Auth::user()->employee);

            return response()->json($leaveTypes);
        }

        public function ajaxPostCreateLeaveRequest(Request $request)
        {
            $requestData = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'leave_type' => 'required',
                'am_pm' => '',
                'reason' => 'required',
                'attachment' => ''
            ]);

            $am_pm = null;
            if(array_key_exists('am_pm', $requestData)) {
                $am_pm = $requestData['am_pm'];
            }

            $attachment_data_url = null;
            if(array_key_exists('attachment', $requestData)) {
                $attachment_data_url = $requestData['attachment'];
            }

            $result = LeaveService::createLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);
            return response()->json($result);
        }

        public function ajaxPostCheckLeaveRequest(Request $request)
        {
            $requestData = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'leave_type' => 'required',
                'am_pm' => ''
            ]);

            $am_pm = null;
            if(array_key_exists('am_pm', $requestData)) {
                $am_pm = $requestData['am_pm'];
            }

            $result = LeaveService::checkLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm);

            return response()->json($result);
        }

        public function postLeaveRequest(Request $request, $id)
        {
            $leaveRequestData = $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'reason' => 'required'
            ]);

            $leaveRequestData['is_template'] = false;


            $leaveRequest = new LeaveRequest($leaveRequestData);

            $employee = Employee::find($id);
            $employee->leave_request()->save($leaveRequest);

            return response()->json(['success' => 'Leave Request is successfully added']);
        }

        public function displayLeaveBalance()
        {
            $leavebalance = LeaveBalance::join('employees','employees.id','=','leave_balance.user_id')
            ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
            ->join('users','users.id','=','employees.user_id')
            ->select('users.name as name','users.id as user_id',
            'leave_balance.balance as balance','leave_balance.id as balance_id',
            'leave_balance.carry_forward as carry',
            'leave_types.name as leave','leave_types.id as type_id')
            ->get();
    
            $users = User::all();
            $types = LeaveType::all();
    
            return view('pages.employee.leave-balance', ['leavebalance'=>$leavebalance,'users'=>$users,'types'=>$types]);        
        }
    

        public function approvedLeaveRequest(Request $request)
        {          
           
            $req_id = $request->input('req_id');
            LeaveRequest::where('id',$req_id)->update(array('is_approved' => '1'));
           
            // $leaveRequest = LeaveRequest::
            // ->get();

            // $spentDay
            // LeaveAllocation::where('em_id',$id)->update(array('spent_days'));
    
            return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
        }
    
        // public function displayLeaveRequest() 25112018
        // {       
    
        //     $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
        //     ->join('users','users.id','=','leave_employees_requests.user_id')
        //     // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
        //     ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
        //     ->select('leave_employees_requests.id as request_id','leave_employees_requests.start_date as start_date',
        //     'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
        //     'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
        //     'leave_employees_requests.status as status')
        //     ->where('leave_employees_requests.user_id' ,Auth::user()->id)
        //     ->get();
    
        //     return view('pages.employee.leave-request', ['leaverequest'=>$leaverequest]);
        // }
    
        // public function displayLeaveBalance()
        // {
        //      $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
        //     ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
        //     ->join('users','users.id','=','employees.user_id')
        //     ->select('users.name as name',
        //     'leave_balance.balance as balance',
        //     'leave_balance.carry_forward as carry',
        //     'leave_types.name as leave')
        //     ->where('users.id', auth()->user()->id)
        //     ->get();
        //     return view('pages.employee.leave-balance', ['leavebalance'=>$leavebalance]);
           
        // }
        public function postReportTo(Request $request, $id)
    {
        $reportToData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'kpi_proposer' => 'required',
            'notes' => 'required',
        ]);

        $reportTo = new EmployeeReportTo($reportToData);


        $employee = Employee::find($id);
        $employee->report_tos()->save($reportTo);

        return response()->json(['success'=>'Record is successfully added']);
    }
    
        public function addLeaveApplication(Request $request)
        {         
            
            $leaveApllicationData =$request->validate([



            ]);

            return redirect()->route('employees');
        




            // $type =  $request->input('leaveTypeId');  
            // $type_id = LeaveType::where('id','=',$type)->first();
    
            // $startDate = $request->input('altStart');      
            // $endDate = $request->input('altEnd');
    
            // $leave_status = "Pending";
            // $reason = $request->input('reason');
            // $leaveBalance = $request->input('leaveBalance');
            // $totalLeave = $request->input('totalLeave');
            // $created_by = Auth::user()->id;
    
            // DB::insert('insert into leave_employees
            // (user_id,id_leave_type,start_balance,
            // leave_status,created_by) 
            // values
            // (?,?,?,
            // ?,?)',
            // [$created_by, $type_id->id, $leaveBalance,
            //  $leave_status,$created_by]);
    
            // DB::insert('insert into leave_employees_requests
            // (user_id,id_leave_type,start_date,
            // end_date, total_days,
            // note, status, created_by) 
            // values
            // (?,?,?,
            // ?,?,
            // ?,?,?)',
            // [$created_by, $type_id->id, $startDate,
            // $endDate, $totalLeave,
            // $reason, $leave_status, $created_by]);
    
            // $leavebalance = LeaveBalance::join('employees','employees.user_id','=','leave_balance.user_id')
            // ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
            // ->join('users','users.id','=','employees.user_id')
            // ->select('users.name as name',
            // 'leave_balance.balance as balance',
            // 'leave_balance.carry_forward as carry',
            // 'leave_types.name as leave')
            // ->where('users.id', Auth::user()->id)
            // ->get();
            // return view('pages.employee.leave-request', ['leavebalance'=>$leavebalance]);
        }
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


    // public function displayConfigurationHoliday()
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

  

    // public function displayLeaveTypeList(){

    //     $typeList=LeaveType::all;
    //     return view('leavelist',compact('typelist'));
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
