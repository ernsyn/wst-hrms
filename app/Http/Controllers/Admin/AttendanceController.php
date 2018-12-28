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

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }
    
    public function getAttendanceReport($date = null)
    {
        if (!$date) {
            $date = Carbon::now()->format('Y-m-d');
        }

        // get attendance data
        $attendances = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->join('employee_attendances', 'employees.id', '=', 'employee_attendances.emp_id')
        ->select('users.name','employees.*','employee_attendances.*')
        ->where('employee_attendances.date', $date)
        ->get();

        // dd($attendances);

        return view('pages.admin.attendance.report', ['attendances' => $attendances, 'selected_date' => $date]);
    }
}
