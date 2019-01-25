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
use App\LeaveRequestApproval;
use App\LeaveAllocation;
use App\LTAppliedRule;
use DatePeriod;
use DateInterval;
use \stdClass;
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
use App\Mail\LeaveRequestMail;

class ELeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);
    }
    
    public function displayLeaveRequestReportTo()
    {
        $user = Auth::user();
        $report_to_emp_id = $user->employee->id;
     //   $leave_request_approval = LeaveRequestApproval::where('approved_by_emp_id','=',$report_to_emp_id)->count();
    
     //select emp_id which have in the list
        $report_to = EmployeeReportTo::select('emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();
        $report_to_employee = EmployeeReportTo::select('report_to_emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

        $leaveRequests =LeaveRequest::with('leave_type','leave_request_approval')
        ->whereIn('emp_id',$report_to)
        ->get();
        $employee = LeaveRequest::with('report_to')->get();
        $report_to = EmployeeReportTo::select('emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();
        $leaveRequests =LeaveRequest::with('leave_type','leave_request_approval')->whereIn('emp_id',$report_to)->get();

        return view('pages.employee.leave.leave-request', ['leaveRequests' => $leaveRequests]);   
    }

    public function displayLeaveRequests()
    {
        $user = Auth::user();
        $emp_id = $user->employee->id;
        $leaveRequests =LeaveRequest::where('emp_id',$emp_id)->get();
        return view('pages.employee.leave.leave-history', ['leaveRequests' => $leaveRequests]);   
    }
    
        //------ for features purposes ------------
    public function find($emp_id)
    {
        $query = EmergencyCOntact::query();

        if ($id) {
            $result = $query->where('id',$id)->first();
        } else {
            $result = $query->where('emp_id', $emp_id)->get();
        }

        return $result;
    }

    public function displayLeaveApplication()
    {      
        $leavebalance = LeaveType::all();
        return view('pages.employee.leave.leave-application', ['leavebalance'=>$leavebalance]);
    }

    public function ajaxGetLeaveTypes()
    {
        $leaveTypes = LeaveService::getLeaveTypesForEmployee(Auth::user()->employee);
        return response()->json($leaveTypes);
    }

    public function ajaxGetEmployeeLeaves(Request $request, $status)
    {
        $leaveRequest = LeaveRequest::where('emp_id', Auth::user()->employee->id)
        ->where('status', $status)
        ->where('start_date', '>=', $request->start)
        ->where('end_date', '<=', $request->end)
        ->get();
        
        $result = array();

        foreach ($leaveRequest as $row) 
        {
            $leave = new stdClass();

            // if($row->am_pm) 
            // {
            //     $leave->allDay = false;
            // }
            // else
            // {
            //     $leave->allDay = true;
            // }

            $leaveType = LeaveType::where('id', $row->leave_type_id)->first();

            $leave->id = $row->id;
            $leave->title = $leaveType->name;
            $leave->start = $row->start_date;
            $leave->end = $row->end_date."T23:59:59";
            $leave->status = $row->status;
            $leave->reason = $row->reason;

            if ($row->am_pm) {
                $leave->am_pm = strtoupper($row->am_pm);
            } else {
                $leave->am_pm = "Full Day";
            }
            
            $result[] = $leave;
        }

        return $result;
    }

    public function ajaxGetHolidays(Request $request)
    {
        $branch = DB::table('employee_jobs')
        ->join('branches', 'employee_jobs.branch_id', '=', 'branches.id')
        ->select('branches.state')
        ->where('employee_jobs.emp_id', Auth::user()->employee->id)
        ->orderBy('employee_jobs.created_at', 'DESC')
        ->first();

        if(empty($branch)) {
            return self::error("Employee job is not set yet.");
        }

        $holidays = Holiday::where('status', 'active')
        ->where('state', 'like', '%' . $branch->state . '%')
        ->where('start_date', '>=', $request->start)
        ->where('end_date', '<=', $request->end)
        ->get();            

        if(empty($holidays)) {
            return self::error("Holidays not set yet.");
        }
        
        $result = array();

        foreach ($holidays as $row) 
        {
            $holiday = new stdClass();

            $holiday->id = $row->id;
            $holiday->title = $row->name;
            $holiday->start = $row->start_date;
            $holiday->end = $row->end_date."T23:59:59";
            $holiday->status = 'holiday';
            $holiday->reason = $row->note;
            // $holiday->allDay = true;
            $result[] = $holiday;
        }

        return $result;
    }

    public function ajaxGetLeaveRequestSingle($id)
    {
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        // dd($leaveRequest);

        return response()->json($leaveRequest);
    }

    public function ajaxGetEmployeeWorkingDays()
    {
        $working_day = Auth::user()->employee->working_day;

        if(empty($working_day)) {
            return self::error("Employees working days not set yet.");
        }
        
        $result = array();
        $work_day = array('full', 'half');

        if (in_array($working_day->sunday, $work_day)) {
            array_push($result, 0);
        }

        if(in_array($working_day->monday, $work_day)) {
            array_push($result, 1);
        }

        if(in_array($working_day->tuesday, $work_day)) {
            array_push($result, 2);
        }

        if(in_array($working_day->wednesday, $work_day)) {
            array_push($result, 3);
        }

        if(in_array($working_day->thursday, $work_day)) {
            array_push($result, 4);
        }

        if(in_array($working_day->friday, $work_day)) {
            array_push($result, 5);
        }

        if(in_array($working_day->saturday, $work_day)) {
            array_push($result, 6);
        }

        return $result;
    }

    public function ajaxCheckEmployeeJob()
    {
        $employeeJob = EmployeeJob::where('emp_id', Auth::user()->employee->id)->count();
        return $employeeJob;
    }

    //create leave request
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
        $leave_request = LeaveRequest::find($result)->first();

        // send leave request email notification
        self::sendLeaveRequestNotification($leave_request);
        return response()->json($result);
    }

    public function ajaxPostEditLeaveRequest(Request $request, $id)
    {
        $requestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'am_pm' => '',
            'reason' => 'required',
            'attachment' => ''
        ]);

        // update leave allocations and remove previous leave request
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', Auth::user()->employee->id)
        ->where('leave_type_id', $request['leave_type'])
        ->where('valid_from_date', '<=', $now)
        ->where('valid_until_date', '>=', $now)
        ->first();

        $leaveAllocation->update([
            'spent_days' => $leaveAllocation->spent_days - $leaveRequest->applied_days
        ]);

        $leaveRequest->delete();

        $am_pm = null;
        if(array_key_exists('am_pm', $requestData)) {
            $am_pm = $requestData['am_pm'];
        }

        $attachment_data_url = null;
        if(array_key_exists('attachment', $requestData)) {
            $attachment_data_url = $requestData['attachment'];
        }

        $result = LeaveService::createLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);
        $leave_request = LeaveRequest::where('id', $result)->first();

        // send leave request email notification
        self::sendLeaveRequestNotification($leave_request);
        return response()->json($result);
    }

    public function sendLeaveRequestNotification(LeaveRequest $leave_request) 
    {
        $cc_recepients = array();
        $bcc_recepients = array();
        
        // get report to users
        $report_to = EmployeeReportTo::where('emp_id', Auth::user()->employee->id)
        ->where('report_to_level', '1')
        ->get();

        foreach ($report_to as $row) {
            $employee = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->select('users.name','users.email')
            ->where('employees.id', $row->report_to_emp_id)
            ->first();

            array_push($cc_recepients, $employee->email);
        }

        // get admin users
        $admin_users = User::whereHas("roles", function($q){ 
            $q->where("name", "admin");
        })->get();

        foreach ($admin_users as $row) {
            array_push($bcc_recepients, $row->email);
        }

        \Mail::to($cc_recepients)
        ->cc(Auth::user()->email)
        ->bcc($bcc_recepients)
        ->send(new LeaveRequestMail(Auth::user(), $leave_request));
    }

    public function ajaxCancelLeaveRequest($id)
    {
        // update leave allocations and remove previous leave request
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', Auth::user()->employee->id)
        ->where('leave_type_id', $leaveRequest['leave_type_id'])
        ->where('valid_from_date', '<=', $now)
        ->where('valid_until_date', '>=', $now)
        ->first();

        $leaveAllocation->update([
            'spent_days' => $leaveAllocation->spent_days - $leaveRequest->applied_days
        ]);

        $leaveRequest->delete();
        return response()->json(['success'=>'Leave Request was successfully cancelled.']);
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

    public function ajaxGetLeaveRules($leave_type_id)
    {
        $emp_id = Auth::user()->employee->id;

        $now = Carbon::now();
        $ltAppliedRule = LTAppliedRule::where('leave_type_id', $leave_type_id)
        ->whereNull('deleted_at')
        ->get();

        return response()->json($ltAppliedRule);
    }

    public function ajaxCalculateActualLeaveDays($start_date, $end_date)
    {
        $start_date = explode("-", $start_date);
        $start_string = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];

        $end_date = explode("-", $end_date);
        $end_string = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];

        $start = new DateTime($start_string);
        $end = new DateTime($end_string);

        // Add the previous Sunday to leave period if start is a Monday
        if($start->format('D') == 'Mon') {
            $start->modify('-1 day');
        }
        
        $end->modify('+1 day'); // fix for end date is excluded
        $interval = $end->diff($start);

        // total days
        $days = $interval->days;

        $getHolidays = Holiday::where('start_date', '>=', $start->format('Y-m-d'))->where('status', 'active')->get();

        // Array of holidays to check the dates against
        $holidays = array();

        foreach ($getHolidays as $getHoliday) {
            $includeDatesBetween = new DatePeriod(
                    new DateTime($getHoliday->start_date),
                    new DateInterval('P1D'),
                    new DateTime($getHoliday->end_date.'+1 day') // fix for excluding end_date
            );

            foreach($includeDatesBetween as $date) { 
                if(!in_array($date->format('Y-m-d'), $holidays, true)) {
                    array_push($holidays, $date->format('Y-m-d'));
                } 
            }
        }

        // Create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        foreach($period as $dt) {
            $curr = $dt->format('D');

            // Substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $days--;
                
                // Subtract if Holidays falls on a Sunday
                if($curr == 'Sun' && in_array($dt->format('Y-m-d'), $holidays)) {
                    $days--;
                }
            }
            // Subtract Holidays 
            else if (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }

        return $days;
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
    }

    public function addLeaveApproval(Request $request, $id) 
    {
        $leaveRequest = LeaveRequest::find($id);
        return view('pages.employee.leave.add-leave-request', ['leaveRequest' => $leaveRequest]);
    }        
    
    public function rejectLeaveApproval(Request $request, $id) 
    {
        $leaveRequest = LeaveRequest::find($id);
        return view('pages.employee.leave.reject-leave-request', ['leaveRequest' => $leaveRequest]);
    }

    public function postAddApproval(Request $request)
    {          
        $id = $request->input('id');     
        $emp_id = $request->input('emp_id');    
        $leave_type_id = $request->input('leave_type_id');   
        $total_days =$request->input('total_days');
        $user = Auth::user();
        $report_to_emp_id = $user->employee->id;
        $multiple_approval_levels_required =LTAppliedRule::where('rule','multiple_approval_levels_needed')   //to get multiple_approval_levels_required
        ->where('leave_type_id',$leave_type_id)
        ->count() == 0;

        $employee_report_to_level = EmployeeReportTo::select('report_to_level')  //to check employee report to level = 1 
        ->where('report_to_emp_id','=',$report_to_emp_id)
        ->where('emp_id','=',$emp_id)  
        ->where ('report_to_level','=','1')
        ->count();  // "5"

        $leave_request_approval_by_emp_id = LeaveRequestApproval::where('leave_request_id','=',$id)  //check leave_request id in leave request approval
        ->count();

        $employee_report_to = EmployeeReportTo::where('emp_id','=',$emp_id)->count();
        $leave_request_approval = LeaveRequestApproval::where('leave_request_id','=',$id)->count(); //check leave_request id in leave request approval
        
        if ($multiple_approval_levels_required == false) {
            if ($leave_request_approval == 0){    //if leave request approval = 0 then 

                if($employee_report_to_level == 1){     // if report to level = 1 
                    LeaveRequest::where('id',$id)->update(array('status' => 'new'));      //then update leave request status = new
                    $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();                       
                    $leaveRequestData = $request->validate([
                        ]);
        
                    $user = Auth::user();
                    $report_to_emp_id = $user->employee->id;
                    $leaveRequestData['leave_request_id'] =$request->id;
                    $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;
                    $leaveRequestData = new LeaveRequestApproval($leaveRequestData);  
                    $employee = Employee::find($report_to_emp_id);
                    $employee->leave_request_approvals()->save($leaveRequestData);
        
                    return redirect()->route('leaverequest')->with('status','Leave Request Approved Level One');
                } else {
                    return redirect()->route('leaverequest')->with('status','You are not first approver');
                }
            } else if($employee_report_to_level == 1) {     
                    return redirect()->route('leaverequest')->with('status','You are not first approver');
            } else {
                LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
                $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                $leaveRequestData = $request->validate([
                        ]);
        
                $user = Auth::user();
                $report_to_emp_id = $user->employee->id;
                $leaveRequestData['leave_request_id'] =$request->id;
                $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;

                $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
                $employee = Employee::find($report_to_emp_id);
            
                $employee->leave_request_approvals()->save($leaveRequestData);
        
                return redirect()->route('leaverequest')->with('status','Leave Request Approved');
            }
        } else {
            LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
            $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
            $leaveRquestData = $request->validate([
                    ]);
    
            $user = Auth::user();
            $report_to_emp_id = $user->employee->id;
            $leaveRequestData['leave_request_id'] =$request->id;
            $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;

            $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
            $employee = Employee::find($report_to_emp_id);
            $employee->leave_request_approvals()->save($leaveRequestData);
            return redirect()->route('leaverequest')->with('status','Leave Request Approved');
        }
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
    }
    
    private static function error($message) 
    {
        return [
            'error' => true,
            'message' => $message
        ];
    }
}    
    