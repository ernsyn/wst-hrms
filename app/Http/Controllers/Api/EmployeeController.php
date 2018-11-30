<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Resources\EmployeeWorkingDay as EmployeeWorkingDayResource;

use App\Employee;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);
    }

    public function getWorkingDays()
    {
        $workingDays = Auth::user()->employee->working_day;

        return response()->json(['working_days' => new EmployeeWorkingDayResource($workingDays)], 200);    
    }
}
