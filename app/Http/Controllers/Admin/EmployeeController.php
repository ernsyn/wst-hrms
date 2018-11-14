<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }

    public function index()
    {       
       // $userlist = User::orderBy('id', 'Desc')->get();
        // $employee_users = User::whereHas("roles", function($q){ $q->where("name", "employee"); })->get();
        // dd($employee_users[0]->employee->id);

        $employees = Employee::all();
        
        return view('pages.admin.employees.index', ['employees'=> $employees]);
    }

    public function displayEmployee($id)
    {
        // $user = User::join('employees','employees.user_id','=','users.id')
        // // ->join('countries','countries.id','=','employees.nationality')
        // //->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        // ->select('users.name as name','users.email as email', 
        // 'employees.contact_no as contact_no', 'employees.address as address', 
        // 'employees.ic_no as ic_no', 'employees.gender as gender', 
        // 'employees.dob as dob','employees.marital_status as marital_status',
        // 'employees.race as race', 'employees.total_children as total_child', 
        // 'employees.driver_license_no as driver_license_no', 
        // 'employees.driver_license_expiry_date as driver_license_expiry_date',
        // 'users.id as user_id','employees.epf_no as epf_no',
        // 'employees.tax_no as tax_no ','employees.basic_salary as basic_salary')
        // ->where('employees.id',$id)
        // ->first();

        $employee = Employee::find($id);


        return view('pages.admin.employees.id', ['employee' => $employee]);        
    }
}
