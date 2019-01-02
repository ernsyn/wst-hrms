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

use App\EmployeeWorkingDay;
use \stdClass;
use App\Http\Services\LeaveService;
use App\Mail\LeaveRequestMail;
use App\Mail\LeaveApprovalMail;
use App\Employee;
use Carbon\Carbon;
use App\User;

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

    public function addLeaveType() 
    {
        return view('pages.admin.e-leave.configuration.add-leave-type');
    }

    public function postAddLeaveType(Request $request) 
    {
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

    public function editLeaveType(Request $request, $id) 
    {
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

        $now = Carbon::now();

        $show_button = false;
        $add_year = $now->year;
        $check_next_year = false;

        if(count($holiday) > 0)
        {
            // get current year holidays
            $holidays_year = Holiday::selectRaw('YEAR(start_date) as holiday_year')
            ->where('repeat_annually', 1)
            ->whereYear('start_date', '=', $now->year)
            ->whereYear('end_date', '=', $now->year)
            ->orderBy('start_date', 'DESC')
            ->first();

            if($holidays_year)
            {
                $show_button = true;

                $add_year = $holidays_year->holiday_year + 1;

                $check_next_year = Holiday::whereYear('start_date', '=', $add_year)
                ->whereYear('end_date', '=', $add_year)
                ->count() > 0;
            }
            else
            {
                $show_button = true;
            }
        }        
        
        return view('pages.admin.e-leave.configuration.leave-holidays', ['holiday' => $holiday, 'next_year' => $add_year, 'disable_button' => $check_next_year, 'show_button' => $show_button]);
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

    public function editHoliday(Request $request, $id) 
    {
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

    public function generatePublicHolidays()
    {
        $now = Carbon::now();

        // get holidays for current year
        $holidays = Holiday::where('repeat_annually', 1)
        ->whereYear('start_date', '=', $now->year)
        ->whereYear('end_date', '=', $now->year)
        ->orderBy('start_date', 'ASC')
        ->get();

        if(count($holidays) == 0)
        {
            $previous_year = $now->year - 1;

            $holidays = Holiday::where('repeat_annually', 1)
            ->whereYear('start_date', '=', $previous_year)
            ->whereYear('end_date', '=', $previous_year)
            ->orderBy('start_date', 'ASC')
            ->get();
        }

        foreach ($holidays as $row) {
            $start = new Carbon($row->start_date);
            $end = new Carbon($row->end_date);
            $start_next = $start->addYear();
            $end_next = $end->addYear();

            // check if holiday has already been duplicated
            $check_exist = Holiday::where('name', $row->name)
            ->where('start_date', $start_next)
            ->where('end_date', $end_next)
            ->count() > 0;

            // duplicate holidays for next year
            if(!$check_exist) {
                $holidayData = array();

                $holidayData['name'] = $row->name;
                $holidayData['start_date'] = $start_next;
                $holidayData['end_date'] = $end_next;
                $holidayData['note'] = $row->note;
                $holidayData['status'] = $row->status;
                $holidayData['repeat_annually'] = $row->repeat_annually;
                $holidayData['total_days'] = $row->total_days;
                $holidayData['state'] = $row->state;

                $holiday = new Holiday($holidayData);
                $holiday->save();
            }
        }
    }

    public function postEditLeaveType(Request $request, $id) 
    {
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

    public function addLeaveApproval(Request $request, $id) 
    {    
        $leaveRequest = LeaveRequest::find($id);

        return view('pages.admin.e-leave.application.add-leave-request', ['leaveRequest' => $leaveRequest]);
    }        

    public function rejectLeaveApproval(Request $request, $id) 
    {
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

        $leave_request_approval = LeaveRequestApproval::where('leave_request_id', $id)->first();

        // send leave request email notification
        self::sendLeaveRequestApprovalNotification($leave_request_approval, $emp_id);
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

    public function postDeactivateLeaveType(Request $request, $id) 
    {
        $leaveType = LeaveType::where('id', $id)->update(['active' => false]);

        return response()->json(['success'=>'Leave type has been deactivated.']);
    }

    public function postActivateLeaveType(Request $request, $id) 
    {
        $leaveType = LeaveType::where('id', $id)->update(['active' => true]);

        return response()->json(['success'=>'Leave type has been activated.']);
    }

    public function deleteLeaveType(Request $request, $id) 
    {
        $leaveType = LeaveType::where('id', $id)->delete();

        return response()->json(['success'=>'Leave type has been deleted.']);
    }

    // Leave Application Calendar View and Form
    public function displayLeaveApplication()
    {      
        $leavebalance = LeaveType::all();

        return view('pages.admin.e-leave.configuration.leave-application');
    }

    // Leave Report
    public function displayLeaveReports()
    {      
        $employees = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->select('users.name','users.email','employees.*')
        ->get();
        
        return view('pages.admin.e-leave.configuration.leave-report', ['employees' => $employees]);
    }

    public function getLeaveReport(Request $request, $id) 
    {
        if (strpos($id, '-') !== false) {
            $params = explode('-', $id);
            $emp_id = $params[0];
            $year = $params[1];
        }
        else {
            $emp_id = $id;
            $now = Carbon::now();
            $year = $now->year;
        }
        
        $report_array = array();

        // get employee data
        $employee = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->select('users.name','users.email','employees.*')
        ->where('employees.id', $emp_id)
        ->first();

        // get employee leave allocations
        $leaves = DB::table('leave_types')
        ->join('leave_allocations', 'leave_types.id', '=', 'leave_allocations.leave_type_id')
        ->select(
            'leave_types.id',
            'leave_types.code',
            'leave_types.name',
            'leave_allocations.allocated_days',
            'leave_allocations.spent_days',
            'leave_allocations.carried_forward_days'
        )
        ->where('leave_types.active', 1)
        ->where('leave_allocations.emp_id', $emp_id)
        ->whereYear('leave_allocations.valid_from_date', '=', $year)
        ->whereYear('leave_allocations.valid_until_date', '=', $year)
        ->get();

        foreach ($leaves as $row) {
            $report_array[$row->id]['code'] = $row->code;
            $report_array[$row->id]['name'] = $row->name;
            $report_array[$row->id]['carried_forward_days'] = round($row->carried_forward_days, 0);
            $report_array[$row->id]['allocated_days'] = round($row->allocated_days, 0);
            $report_array[$row->id]['pending'] = 0;
            $report_array[$row->id]['approved'] = 0;
            $report_array[$row->id]['rejected'] = 0;
            $report_array[$row->id]['allowed_to_take'] = 0;
            $report_array[$row->id]['year_of_balance'] = 0;
        }

        // get employee leave request data
        $requests = LeaveRequest::groupBy('leave_type_id')
        ->selectRaw('leave_type_id, 
        SUM(CASE WHEN status = "new" THEN applied_days ELSE 0 END) AS pending,
        SUM(CASE WHEN status = "approved" THEN applied_days ELSE 0 END) AS approved,
        SUM(CASE WHEN status = "rejected" THEN applied_days ELSE 0 END) AS rejected')
        ->where('emp_id', $emp_id)
        ->whereYear('start_date', '=', $year)
        ->whereYear('end_date', '=', $year)
        ->get();

        foreach ($requests as $row) {
            $pending = round($row->pending, 0);
            $approved = round($row->approved, 0);
            $rejected = round($row->rejected, 0);

            $report_array[$row->leave_type_id]['pending'] = round($row->pending, 0);
            $report_array[$row->leave_type_id]['approved'] = round($row->approved, 0);
            $report_array[$row->leave_type_id]['rejected'] = round($row->rejected, 0);
        }

        // total columns
        foreach ($report_array as $key => $value) {
            $report_array[$key]['allowed_to_take'] = $report_array[$key]['allocated_days'] - ($report_array[$key]['pending'] + $report_array[$key]['approved']);
            $report_array[$key]['year_of_balance'] = $report_array[$key]['allocated_days'] - ($report_array[$key]['approved']);
        }

        $years = LeaveRequest::selectRaw('distinct(year(start_date)) as year_data')
        ->where('emp_id', $emp_id)
        ->get();

        return view('pages.admin.e-leave.configuration.total-balanced-report', ['employee' => $employee, 'leaves' => $report_array, 'year_data' => $years, 'selected_year' => $year]);
    }

    public function ajaxGetEmployees(Request $request)
    {
        $pageLimit = $request->get("page_limit");
        $nameQuery = $request->get("q");
        $employees = Employee::with('user:id,name')
        ->whereHas('user', function ($q) use ($nameQuery) {
            $q->where('name', 'like', "%{$nameQuery}%");
        })
        ->take($pageLimit)
        ->get(['id', 'code', 'user_id']);

        $employee_list = [];

        foreach($employees as $employee) {
            array_push($employee_list, [
                'id' => $employee->id,
                'name' => $employee->user->name,
                'code' => $employee->code
            ]);
        }
        return response()->json($employee_list);
    }

    public function ajaxGetEmployeeWorkingDays($emp_id)
    {
        $working_day = EmployeeWorkingDay::where('emp_id', $emp_id)->first();
    
        if(empty($working_day)) {
            return self::error("Employees working days not set yet.");
        }
        
        $result = array();

        $work_day = array('full', 'half');

        if(in_array($working_day->sunday, $work_day))
        {
            array_push($result, 0);
        }

        if(in_array($working_day->monday, $work_day))
        {
            array_push($result, 1);
        }

        if(in_array($working_day->tuesday, $work_day))
        {
            array_push($result, 2);
        }

        if(in_array($working_day->wednesday, $work_day))
        {
            array_push($result, 3);
        }

        if(in_array($working_day->thursday, $work_day))
        {
            array_push($result, 4);
        }

        if(in_array($working_day->friday, $work_day))
        {
            array_push($result, 5);
        }

        if(in_array($working_day->saturday, $work_day))
        {
            array_push($result, 6);
        }

        return $result;
    }

    public function ajaxGetEmployeeLeaves(Request $request, $emp_id)
    {
        $leaveRequest = LeaveRequest::where('emp_id', $emp_id)
        ->where('status', $request->input('status'))
        ->where('start_date', '>=', $request->input('start'))
        ->where('end_date', '<=', $request->input('end'))
        ->get();
        
        $result = array();

        foreach ($leaveRequest as $row) 
        {
            $leave = new stdClass();

            $leaveType = LeaveType::where('id', $row->leave_type_id)->first();

            $leave->id = $row->id;
            $leave->title = $leaveType->name;
            $leave->start = $row->start_date;
            $leave->end = $row->end_date."T23:59:59";
            $leave->status = $row->status;
            $leave->reason = $row->reason;

            if($row->am_pm)
            {
                $leave->am_pm = strtoupper($row->am_pm);
            }
            else 
            {
                $leave->am_pm = "Full Day";
            }
            
            $result[] = $leave;
        }

        return $result;
    }

    public function ajaxGetEmployeeHolidays(Request $request, $emp_id)
    {
        $branch = DB::table('employee_jobs')
        ->join('branches', 'employee_jobs.branch_id', '=', 'branches.id')
        ->select('branches.state')
        ->where('employee_jobs.emp_id', $emp_id)
        ->orderBy('employee_jobs.created_at', 'DESC')
        ->first();

        if(empty($branch)) {
            return self::error("Employee job is not set yet.");
        }

        $holidays = Holiday::where('status', 'active')
        ->where('state', 'like', '%' . $branch->state . '%')
        ->where('start_date', '>=', $request->input('start'))
        ->where('end_date', '<=', $request->input('end'))
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
            $result[] = $holiday;
        }

        return $result;
    }

    public function ajaxGetLeaveTypes($emp_id)
    {
        $employee = Employee::where('id', $emp_id)->first();

        $leaveTypes = LeaveService::getLeaveTypesForEmployee($employee, true);

        return response()->json($leaveTypes);
    }

    public function ajaxPostCheckLeaveRequest(Request $request, $emp_id)
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

        $employee = Employee::where('id', $emp_id)->first();

        $result = LeaveService::checkLeaveRequest($employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, true);

        return response()->json($result);
    }

    public function ajaxPostCreateLeaveRequest(Request $request, $emp_id)
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

        $employee = Employee::where('id', $emp_id)->first();

        $result = LeaveService::createLeaveRequest($employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);

        $leave_request = LeaveRequest::where('id', $result)->first();

        // send leave request email notification
        self::sendLeaveRequestNotification($leave_request, $emp_id);

        return response()->json($result);
    }

    public function ajaxGetLeaveRequestSingle($id)
    {
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        return response()->json($leaveRequest);
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
        $employee = Employee::where('id', $leaveRequest->emp_id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', $employee->id)
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

        $result = LeaveService::createLeaveRequest($employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);

        $leave_request = LeaveRequest::where('id', $result)->first();

        // send leave request email notification
        self::sendLeaveRequestNotification($leave_request, $employee->id);

        return response()->json($result);
    }

    public function ajaxCancelLeaveRequest($id)
    {
        // update leave allocations and remove previous leave request
        $leaveRequest = LeaveRequest::where('id', $id)->first();
        $employee = Employee::where('id', $leaveRequest->emp_id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', $employee->id)
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

    public function sendLeaveRequestNotification(LeaveRequest $leave_request, $emp_id) {
        $cc_recepients = array();
        $bcc_recepients = array();
        
        // get report to users
        $report_to = EmployeeReportTo::where('emp_id', $emp_id)
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

        \Mail::to(Auth::user()->email)
        ->cc($cc_recepients)
        ->bcc($bcc_recepients)
        ->send(new LeaveRequestMail(Auth::user(), $leave_request));
    }
    public function sendLeaveRequestApprovalNotification(LeaveRequestApproval $leave_request_approval, $emp_id) {
        $cc_recepients = array();
        $bcc_recepients = array();
        
        // get report to users
        $report_to = EmployeeReportTo::where('emp_id', $emp_id)
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

        \Mail::to(Auth::user()->email)
        ->cc($cc_recepients)
        ->bcc($bcc_recepients)
        ->send(new LeaveApprovalMail(Auth::user(), $leave_request_approval));
    }
}
