<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Services\LeaveService;

class ELeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);
    }

    public function getLeaveTypes()
    {
        $leaveTypes = LeaveService::getLeaveTypesForEmployee(Auth::user()->employee);

        return response()->json($leaveTypes);
    }

    public function postGetLeaveRequests(Request $request)
    {
        $requestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $leaveRequests = LeaveService::getLeaveRequestsForEmployee(Auth::user()->employee, $requestData['start_date'], $requestData['end_date']);

        return response()->json($leaveRequests);
    }

    public function postCreateLeaveRequest(Request $request)
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

    public function postCheckLeaveRequest(Request $request)
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
}
