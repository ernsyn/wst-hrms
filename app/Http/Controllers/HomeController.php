<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaverequest = LeaveRequest:: join('employees','employees.user_id','=','leave_employees_requests.user_id')
        ->join('users','users.id','=','leave_employees_requests.user_id')
        // ->join('employee_jobs','employee_jobs.emp_id','=','leave_employees_requests.user_id')
        ->join('leave_types','leave_types.id','=','leave_employees_requests.id_leave_type')
        ->select('leave_employees_requests.start_date as start_date',
        'leave_employees_requests.end_date as end_date','leave_employees_requests.total_days as total_days',
        'users.name as name','leave_employees_requests.user_id as emp','leave_types.name as leave_type',
        'leave_employees_requests.status as status')
        ->get();

        return view('home', ['leaverequest'=>$leaverequest]);
    }
}
