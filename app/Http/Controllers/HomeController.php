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
        if($user->hasRole('employee')) {
            return redirect()->route('leaveapplication');
        } else if($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } else if($user->hasRole('super-admin')) {
            return redirect()->route('super-admin.dashboard');
        }

        abort(404);
    }
}
