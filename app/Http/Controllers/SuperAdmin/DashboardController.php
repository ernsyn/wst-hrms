<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\SecurityGroup;
use App\Team;
use App\EmployeePosition;
use App\EmployeeGrade;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Super Admin']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $initCheck = array(
            "companiesCount" => Company::count(),
            "costCentresCount" => CostCentre::count(),
            "departmentsCount" => Department::count(),
            "branchesCount" => Branch::count(),
            "teamsCount" => Team::count(),
            "employeePositionsCount" => EmployeePosition::count(),
            "employeeGradesCount" => EmployeeGrade::count(),
            "securityGroupCount" => SecurityGroup::count(),
        );

        $initOk = true;
        foreach ($initCheck as $count) {
            if($count <= 0) {
                $initOk = false;
            }
        }
        $initCheck["ok"] = $initOk;

        return view('pages.super-admin.dashboard', ['initCheck' => $initCheck]);
    }
}
