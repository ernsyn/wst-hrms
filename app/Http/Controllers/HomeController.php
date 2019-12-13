<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;

use Auth;
use App\Helpers\AccessControllHelper;

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
        
        $adminPermissions = array();
        $employeePermissions = array();
        
        foreach(AccessControllHelper::adminPermissions() as $p){
            array_push($adminPermissions, $p);
        }
        
        foreach(AccessControllHelper::employeePermissions() as $p){
            array_push($employeePermissions, $p);
        }
        
        if($user->hasAnyPermission($employeePermissions)) {
            return redirect()->route('employee.e-leave.leave-application');
        } else if($user->hasAnyPermission($adminPermissions)) {
            return redirect()->route('admin.dashboard');
        } else if($user->hasRole('Super Admin')) {
            return redirect()->route('super-admin.dashboard');
        }
        abort(404);
    }
}
