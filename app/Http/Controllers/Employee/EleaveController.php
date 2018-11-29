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
        $leave_request_approval = LeaveRequestApproval::where('emp_id','=',$id)->count();

        
        $report_to = EmployeeReportTo::where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

        $leaveRequests =LeaveRequest::with('leave_type')->whereIn('emp_id',$report_to)->get();

        return view('pages.employee.leave.leave-request', ['leaveRequests' => $leaveRequests]);


        
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
            $multiple_approval_levels_required =LTAppliedRule::where('rule','multiple_approval_levels_required')
            ->where('leave_type_id',$leave_type_id)
            ->count() == 0;
  

            //employee_report_to level 
            $employee_report_to = EmployeeReportTo::where('emp_id','=',$id)->count();
      
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
                    // $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                    // ->where('leave_type_id',$leave_type_id)
                    // ->update(array('spent_days'=>$leaveAllocationDataEntry));
        
                    
                    $leaveRequestData = $request->validate([
                          ]);
            
                        $leaveRequestData['leave_request_id'] =$request->id;
                        $leaveRequestData['approved_by_emp_id'] = auth()->user()->id;
            
                        $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
                        $employee = Employee::find($id);
                        $employee->leave_request_approvals()->save($leaveRequestData);
            
                        return redirect()->route('leaverequest');
        

                }
                if ($leave_request_approval < $employee_report_to){
                    LeaveRequest::where('id',$id)->update(array('status' => 'new'));
                    $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                    $leaveRquestData = $request->validate([
                          ]);
            
                        $leaveRquestData['leave_request_id'] =$request->id;
                        $leaveRquestData['approved_by_emp_id'] = auth()->user()->id;
                        $leaveRquestData = new LeaveRequestApproval($leaveRquestData);
                        $employee = Employee::find($id);
                        $employee->leave_request_approvals()->save($leaveRquestData);
            
                        return redirect()->route('leaverequest');
                    }

                    else{ 
                        LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
                        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                        // $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                        // ->where('leave_type_id',$leave_type_id)
                        // ->update(array('spent_days'=>$leaveAllocationDataEntry));
                        $leaveRquestData = $request->validate([
                              ]);
                
                            $leaveRquestData['leave_request_id'] =$request->id;
                            $leaveRquestData['approved_by_emp_id'] = auth()->user()->id;
                
                            $leaveRquestData = new LeaveRequestApproval($leaveRquestData);
                            $employee = Employee::find($id);
                            $employee->leave_request_approvals()->save($leaveRquestData);
                
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
        
                    $leaveRquestData['leave_request_id'] =$request->id;
                    $leaveRquestData['approved_by_emp_id'] = auth()->user()->id;
        
                    $leaveRquestData = new LeaveRequestApproval($leaveRquestData);
                    $employee = Employee::find($id);
                    $employee->leave_request_approvals()->save($leaveRquestData);
        
                    return redirect()->route('leaverequest');
    
            }
    

        }

            public function postDisapproved(Request $request)
            {          
    
                $id = $request->input('id');     
                LeaveRequest::where('id',$id)->update(array('status' => 'rejected'));
                $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                $leaveAllocationData = LeaveAllocation::find( $id );
                $leaveAllocationData->spent_days += 1;
                $leaveAllocationData->save();
            
        

        
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
           
    