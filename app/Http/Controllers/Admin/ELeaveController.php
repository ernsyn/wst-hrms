<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\LeaveType;

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
}
