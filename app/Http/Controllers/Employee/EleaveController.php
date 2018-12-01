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
    
        $report_to = EmployeeReportTo::select('emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

        $leaveRequests =LeaveRequest::with('leave_type','leave_request_approval')->whereIn('emp_id',$report_to)->get();

        // $leave = LeaveRequest::find(1);
        // $exists = $leave->leave_request_approval->contains($id);
        // $leaveRequests->leave_request_approval; // Collection with 1 or more items, evaluates to true as well
        // count($leaveRequests->leave_request_approval); // 

        $employee = LeaveRequest::with('report_to')->get();

        return view('pages.employee.leave.leave-request', ['leaveRequests' => $leaveRequests]);   
    }

    // public function displayLeaveRequestReportTo()
    // {
    //     $user = Auth::user();
    //     $report_to_emp_id = $user->employee->id;
    //     $leave_request_approval = LeaveRequestApproval::where('approved_by_emp_id','=',$report_to_emp_id)->get();

    //     $report_to = EmployeeReportTo::where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

    //     dd($report_to);
     
    //     // $report_to_level_1 = EmployeeReportTo::where('report_to_emp_id',$report_to_emp_id)
    //     // ->where('report_to_level',1)
    //     // ->get()->toArray();

    //     // $report_to_level_2 = EmployeeReportTo::where('report_to_emp_id',$report_to_emp_id)
    //     // ->where('report_to_level',2)
    //     // ->get()->toArray();



    //     $leaveRequests =LeaveRequest::with('leave_type')
    //     ->whereIn('emp_id',$report_to)
    //     // ->whereIn('id',$leave_request_approval)   
    //     ->get();

    //     dd($leaveRequests);

    //     $leaveRequestApprovalCount = LeaveRequestApproval::with('leave_request_approval')
    //     ->whereIn('leave_request_id',$report_to)
    //     //  ->whereIn('report_to_level',1)
    //     ->count();



   
    //     return view('pages.employee.leave.leave-request', ['leaveRequests' => $leaveRequests]);   
    // }
    

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
    
            if($id){
                $result = $query->where('id',$id)->first();
            }else{
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

        public function ajaxGetLeaveRequestSingle($id)
        {
            dd("hellop");
            $leaveRequest = LeaveService::getLeaveRequestSingle($id);

            return response()->json($leaveRequest);
        }

        public function ajaxGetEmployeeLeaves($status)
        {
            $leaveRequest = LeaveService::getEmployeeLeaves(Auth::user()->employee->id, $status);
            
            $result = array();

            foreach ($leaveRequest as $row) 
            {
                $leave = new stdClass();

                if($row->am_pm) 
                {
                    $leave->allDay = false;
                }
                else
                {
                    $leave->allDay = true;
                }

                $leave->id = $row->id;
                $leave->title = $row->reason;
                $leave->start = $row->start_date;
                $leave->end = $row->end_date;
                $leave->status = $row->status;
                $result[] = $leave;
            }

            return $result;
        }

        public function ajaxGetEmployeeWorkingDays()
        {
            $working_day = Auth::user()->employee->working_day;
        
            if(empty($working_day)) {
                return self::error("Employees working days not set yet.");
            }
            
            $result = array();

            if($working_day->sunday > 0)
            {
                array_push($result, 0);
            }

            if($working_day->monday > 0)
            {
                array_push($result, 1);
            }

            if($working_day->tuesday > 0)
            {
                array_push($result, 2);
            }

            if($working_day->wednesday > 0)
            {
                array_push($result, 3);
            }

            if($working_day->thursday > 0)
            {
                array_push($result, 4);
            }

            if($working_day->friday > 0)
            {
                array_push($result, 5);
            }

            if($working_day->saturday > 0)
            {
                array_push($result, 6);
            }

            return $result;
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

        public function ajaxPostEditLeaveRequest(Request $request, $id)
        {
            $leaveRequestUpdateData = $request->validate([
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

            LeaveRequest::where('id', $id)->update($leaveRequestUpdateData);

            return response()->json(['success'=>'Working Day was successfully updated.']);
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
    
        }

            public function addLeaveApproval(Request $request, $id) {
    
                $leaveRequest = LeaveRequest::find($id);
    
                return view('pages.employee.leave.add-leave-request', ['leaveRequest' => $leaveRequest]);
            }        
        
        public function rejectLeaveApproval(Request $request, $id) {
    
            $leaveRequest = LeaveRequest::find($id);

            return view('pages.employee.leave.reject-leave-request', ['leaveRequest' => $leaveRequest]);
        }
    
        public function postAddApproval(Request $request)
        {          

            $id = $request->input('id');     
            $emp_id = $request->input('emp_id');    
            $leave_type_id = $request->input('leave_type_id');   
            $total_days =$request->input('total_days');

            //to get multiple_approval_levels_required
            $multiple_approval_levels_required =LTAppliedRule::where('rule','multiple_approval_levels_needed')
            ->where('leave_type_id',$leave_type_id)
            ->count() == 0;
  
// dd($multiple_approval_levels_required);
            //employee_report_to level 
            $employee_report_to = EmployeeReportTo::where('emp_id','=',$emp_id)->count();
      
            $employee_report_to = $employee_report_to -1;

            $leave_request_approval = LeaveRequestApproval::where('leave_request_id','=',$id)->count();
            
            //get allocation total_days
    //         $leaveAllocationData1 = LeaveAllocation::select ('spent_days')->where('emp_id',$emp_id)
    //         ->where('leave_type_id',$leave_type_id)->first()->spent_days;
     
    //  //       dd($leaveAllocationData);
    //         $leaveAllocationData = number_format($leaveAllocationData1,1);
    //         $leaveAllocationDataEntry = $leaveAllocationData + $total_days;


            if ($multiple_approval_levels_required == false) {

                if ($leave_request_approval == $employee_report_to){   
                    
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
          
                      return redirect()->route('leaverequest');
        

                }
            elseif ($leave_request_approval < $employee_report_to){
                    LeaveRequest::where('id',$id)->update(array('status' => 'new'));
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
          
                      return redirect()->route('leaverequest');
                    }

                    else{ 
                        LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
                        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                        // $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                        // ->where('leave_type_id',$leave_type_id)
                        // ->update(array('spent_days'=>$leaveAllocationDataEntry));
                        $leaveRequestData = $request->validate([
                              ]);
                
                            $user = Auth::user();
                          $report_to_emp_id = $user->employee->id;
                        $leaveRequestData['leave_request_id'] =$request->id;
                        $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;
 
                        $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
                            $employee = Employee::find($report_to_emp_id);
                    
                            $employee->leave_request_approvals()->save($leaveRequestData);
                
                            return redirect()->route('leaverequest');
                        }

            }

            else 
            {
    
                LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
                $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                // $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                // ->where('leave_type_id',$leave_type_id)
                // ->update(array('spent_days'=>$leaveAllocationDataEntry));
                
                $leaveRquestData = $request->validate([
                      ]);
        
                      $user = Auth::user();
                      $report_to_emp_id = $user->employee->id;
                    $leaveRequestData['leave_request_id'] =$request->id;
                    $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;

                    $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
                        $employee = Employee::find($report_to_emp_id);
                
                        $employee->leave_request_approvals()->save($leaveRequestData);
        
                    return redirect()->route('leaverequest');
            // $spentDay
            // LeaveAllocation::where('em_id',$id)->update(array('spent_days'));
    
        //     return view('pages.admin.leave-request', ['leaverequest'=>$leaverequest]);
        // }
    
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
    }
           
    