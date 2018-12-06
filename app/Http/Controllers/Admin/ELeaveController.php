<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\LeaveType;
use App\Holiday;
use App\LTAppliedRule;
use App\LTEntitlementGradeGroup;
use App\LeaveRequest;
use Auth;
use App\LeaveAllocation;
use App\EmployeeReportTo;
use App\LeaveRequestApproval;
class ELeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }


    
    public function displayConfiguration() 
    {
        $defaultLeaveTypes = LeaveType::default()->get();
        $customLeaveTypes = LeaveType::custom()->get();

        return view('pages.admin.e-leave.configuration', ['defaultLeaveTypes' => $defaultLeaveTypes, 'customLeaveTypes' => $customLeaveTypes]);
    }

    public function addLeaveType() {
        return view('pages.admin.e-leave.configuration.add-leave-type');
    }

    public function postAddLeaveType(Request $request) {
        $leaveTypeData = $request->validate([
            "code" => 'required|unique:leave_types,code,NULL,id,deleted_at,NULL',
            "name" => 'required|unique:leave_types,name,NULL,id,deleted_at,NULL',
            "description" => 'required',
            "entitled_days" => '',
        ]);
        $leaveTypeData['active'] = true;

        $appliedRulesData =  $request->validate([
            "applied_rules" => '',
        ]);

        $gradeGroupsData =  $request->validate([
            "grade_groups" => '',
        ]);

        $conditionalEntitlementsData =  $request->validate([
            "conditional_entitlements" => '',
        ]);

        DB::transaction(function() use ($leaveTypeData, $appliedRulesData, $gradeGroupsData, $conditionalEntitlementsData) {
            $leaveType = LeaveType::create($leaveTypeData);

            if(array_key_exists("applied_rules", $appliedRulesData)) {
                foreach ($appliedRulesData['applied_rules'] as $key => $ruleData)  {
                    if(array_key_exists('configuration', $ruleData)) {
                        $appliedRulesData['applied_rules'][$key]['configuration'] = json_encode($ruleData['configuration']);
                    }
                }
                $leaveType->applied_rules()->createMany(
                    $appliedRulesData['applied_rules']
                );
            }

            if(array_key_exists("grade_groups", $gradeGroupsData)) {
                foreach ($gradeGroupsData["grade_groups"] as $gradeGroupData) {
                    $gradeGroup = $leaveType->lt_entitlements_grade_groups()->create($gradeGroupData);
                    $gradeGroup->grades()->sync($gradeGroupData["grades"]);
                    $gradeGroup->lt_conditional_entitlements()->createMany(
                        $gradeGroupData["conditional_entitlements"]
                    ); 
                }

            } else {
                if(array_key_exists("conditional_entitlements", $conditionalEntitlementsData)) {
                    $leaveType->lt_conditional_entitlements()->createMany(
                        $conditionalEntitlementsData["conditional_entitlements"]
                    ); 
                }
            }
        });

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function editLeaveType(Request $request, $id) {
        $leaveType = LeaveType::with('applied_rules', 'lt_conditional_entitlements', 'lt_entitlements_grade_groups.lt_conditional_entitlements', 'lt_entitlements_grade_groups.grades')->where('id', $id)->first();
        // dd($leaveType);
        if(!$leaveType->is_custom) {
            return view('pages.admin.e-leave.configuration.edit-default-leave-type', [ 'leave_type' => $leaveType]);
        } else {
            return view('pages.admin.e-leave.configuration.edit-custom-leave-type', [ 'leave_type' => $leaveType]);
        }
    }



        // List Of Leave Public Holidays List
public function displayLeaveRequests()
{       
    $leaveRequests = LeaveRequest::all();
    
    return view('pages.admin.e-leave.configuration.leave-requests', ['leaveRequests' => $leaveRequests]);
}

    // List Of Leave Public Holidays List
public function displayPublicHolidays()
{       
    $holiday = Holiday::all();
    
    return view('pages.admin.e-leave.configuration.leave-holidays', ['holiday' => $holiday]);
}

public function addPublicHoliday()
{
    return view('pages.admin.e-leave.configuration.add-leave-holidays');
}

public function postAddPublicHoliday(Request $request)
{
    $publicHolidayData = $request->validate([
        'name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        // 'total_days' => 'required',
        'repeat_annually'=>'required',
        'state'=>'',

       //'status' => 'required',
       'note' => '',

   
    ]);
    $publicHolidayData['state'] = implode(",", $request->state);

    $datetime1 = strtotime($publicHolidayData['start_date']);
    $datetime2 = strtotime($publicHolidayData['end_date']);  
    $created_by = auth()->user()->id;
    $interval =  $datetime2 - $datetime1;
    $days = floor($interval/(60*60*24)) + 1;

    $publicHolidayData['total_days'] =  $days = floor($interval/(60*60*24)) + 1;
   
    $publicHolidayData['status'] =  'active';
   

    Holiday::create($publicHolidayData);

    return redirect()->route('admin.e-leave.configuration.leave-holidays');
}


public function editHoliday(Request $request, $id) {
    $holidays = Holiday::find($id);

    return view('pages.admin.e-leave.configuration.edit-leave-holidays', ['holidays' => $holidays]);
}


public function postEditHoliday(Request $request, $id)
{

    $holidayData = $request->validate([
        'name' => 'required',
        'start_date' =>'required',
        'end_date' => 'required',
        'total_days' =>'required',
        'repeat_annually' => 'required',
        'status' =>'required',
        'note'=>'',
        'state'=>''


    ]);

    Holiday::where('id', $id)->update($holidayData);

    return redirect()->route('admin.e-leave.configuration.leave-holidays')->with('status', 'Holiday has successfully been updated.');
}


    public function postEditLeaveType(Request $request, $id) {
        $leaveType = LeaveType::where('id', $id)->first();
        if($leaveType->is_custom) {

        } else {

            $leaveTypeData = $request->validate([
                "entitled_days" => 'nullable',
            ]);
    
            $appliedRulesData =  $request->validate([
                "applied_rules" => '',
            ]);
    
            $gradeGroupsData =  $request->validate([
                "grade_groups" => '',
            ]);
    
            $conditionalEntitlementsData =  $request->validate([
                "conditional_entitlements" => '',
            ]);
    
            DB::transaction(function() use ($leaveType, $leaveTypeData, $appliedRulesData, $gradeGroupsData, $conditionalEntitlementsData) {
                if(!array_key_exists("entitled_days", $leaveTypeData)) {
                    $leaveTypeData["entitled_days"] = NULL;
                }
                $leaveType->update($leaveTypeData);
    
                if(array_key_exists("applied_rules", $appliedRulesData)) {
                    foreach ($appliedRulesData['applied_rules'] as $key => $ruleData)  {
                        if(array_key_exists('configuration', $ruleData)) {
                            $appliedRulesData['applied_rules'][$key]['configuration'] = json_encode($ruleData['configuration']);
                        }
                    }

                    foreach ($appliedRulesData['applied_rules'] as $key => $ruleData)  {
                        $leaveType->applied_rules()->updateOrCreate(['rule' => $ruleData['rule']], $ruleData);
                    }
                }
    
                if(array_key_exists("grade_groups", $gradeGroupsData)) {
                    $gradeGroupIds = array();
                    foreach ($gradeGroupsData["grade_groups"] as $gradeGroupData) {
                        $gradeGroup =  $leaveType->lt_entitlements_grade_groups()->updateOrCreate(['id' => $gradeGroupData['id']], $gradeGroupData);
                        $gradeGroup->grades()->sync($gradeGroupData['grades']);

                        $conditionalEntitlementIds = array();
                        if(array_key_exists("conditional_entitlements", $gradeGroupData)) {
                            foreach ($gradeGroupData["conditional_entitlements"] as $conditionalEntitlementData) {
                                $conditionalEntitlement =  $gradeGroup->lt_conditional_entitlements()->updateOrCreate(['id' => $conditionalEntitlementData['id']], $conditionalEntitlementData);
                                array_push($conditionalEntitlementIds, $conditionalEntitlement->id);
                            }
                        }
                        $gradeGroup->lt_conditional_entitlements()->whereNotIn('id', $conditionalEntitlementIds)->delete();

                        array_push($gradeGroupIds, $gradeGroup->id);
                    }
                    $leaveType->lt_entitlements_grade_groups()->whereNotIn('id', $gradeGroupIds)->delete();
    
                } else {
                    $leaveType->lt_entitlements_grade_groups()->delete();
                }

                if(array_key_exists("conditional_entitlements", $conditionalEntitlementsData)) {
                    $conditionalEntitlementIds = array();
                    foreach ($conditionalEntitlementsData["conditional_entitlements"] as $conditionalEntitlementData) {
                        $conditionalEntitlement = $leaveType->lt_conditional_entitlements()->updateOrCreate(['id' => $conditionalEntitlementData['id']], $conditionalEntitlementData);
                        array_push($conditionalEntitlementIds, $conditionalEntitlement->id);
                    }
                   
                } else {
                    $leaveType->lt_conditional_entitlements()->delete();
                }
            });
        }

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function addLeaveApproval(Request $request, $id) {
    
        $leaveRequest = LeaveRequest::find($id);

        return view('pages.admin.e-leave.application.add-leave-request', ['leaveRequest' => $leaveRequest]);
    }        

    public function rejectLeaveApproval(Request $request, $id) {

    $leaveRequest = LeaveRequest::find($id);

    return view('pages.admin.e-leave.application.reject-leave-request', ['leaveRequest' => $leaveRequest]);
}

  public function postAddApproval(Request $request)
        {          

            $id = $request->input('id');     
            $emp_id = $request->input('emp_id');    
            $leave_type_id = $request->input('leave_type_id');   
            $total_days =$request->input('total_days');  
 
            LeaveRequest::where('id',$id)->update(array('status' => 'approved'));
            $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
            $leaveRequestData = $request->validate([
                ]);
  

            $leaveRequestData['leave_request_id'] =$id;
            $leaveRequestData['approved_by_emp_id'] = 1;

            $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
           // $employee = Employee::find($report_to_emp_id);
      
            $leaveRequestData->save();

            // $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
            // ->where('leave_type_id',$leave_type_id)
            // ->update(array('spent_days'=>$leaveAllocationDataEntry));
                return redirect()->route('admin.e-leave.configuration.leave-requests');

    

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
                return redirect()->route('admin.e-leave.configuration.leave-requests');

            }

    public function postDeactivateLeaveType(Request $request, $id) {
        $leaveType = LeaveType::where('id', $id)->update(['active' => false]);

        return response()->json(['success'=>'Leave type has been deactivated.']);
    }

    public function postActivateLeaveType(Request $request, $id) {
        $leaveType = LeaveType::where('id', $id)->update(['active' => true]);

        return response()->json(['success'=>'Leave type has been activated.']);
    }

    public function deleteLeaveType(Request $request, $id) {
        $leaveType = LeaveType::where('id', $id)->delete();

        return response()->json(['success'=>'Leave type has been deleted.']);
    }
}
