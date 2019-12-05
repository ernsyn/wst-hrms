<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;

use Auth;

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
        $user = Auth::user();
        if($user->hasRole('Employee')) {
            return redirect()->route('employee.e-leave.leave-application');
        } else if($user->hasRole('HR Admin')) {
            return redirect()->route('admin.dashboard');
        } else if($user->hasRole('Super Admin')) {
            return redirect()->route('super-admin.dashboard');
        }

        abort(404);
    }
}
