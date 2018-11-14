<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;

use App\Country;
use App\Roles;

use App\Employee;
use App\EmployeeDependent;
use App\EmployeeAttachment;
use App\EmployeeBankAccount;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeImmigration;
use App\EmployeeJob;
use App\EmployeeSkill;
use App\EmployeeVisa;
use App\EmployeeEmergencyContact;

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

    public function display($id)
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

        $employee = Employee::with('user', 'employee_jobs')->find($id);


        return view('pages.admin.employees.id', ['employee' => $employee]);        
    }

    public function add()
    {   
        $countries = Country::all();
        $roles = Roles::all();

        return view('pages.admin.employees.add', compact('countries','roles'));
    }


    // SECTION: Data Tables

    public function getDataTableDependents($id)
    {       
        $dependents = EmployeeDependent::where('emp_id', $id)->get();
        return DataTables::of($dependents)->make(true);
    }

    public function getDataTableImmigrations($id)
    {       
        $immigrations = EmployeeImmigration::where('emp_id', $id)->get();
        return DataTables::of($immigrations)->make(true);
    }

    public function getDataTableVisas($id)
    {       
        $visa = EmployeeVisa::where('emp_id', $id)->get();
        return DataTables::of($visa)->make(true);
    }

    public function getDataTableBankAccounts($id)
    {       
        $banks = EmployeeBankAccount::where('emp_id', $id)->get();
        return DataTables::of($banks)->make(true);
    }

    public function getDataTableJobs($id)
    {       
        $job = EmployeeJob::where('emp_id', $id)->get();
        return DataTables::of($job)->make(true);
    }

    public function getDataTableExperiences($id)
    {   
        $experiences = EmployeeExperience::where('emp_id', $id)->get();
        return DataTables::of($experiences)->make(true);
    }

    public function getDataTableEducation($id)
    {   
        $educations = EmployeeEducation::where('emp_id', $id)->get();
        return DataTables::of($educations)->make(true);
    }

    public function getDataTableSkills($id)
    {   
        $skills = EmployeeSkill::where('emp_id', $id)->get();
        return DataTables::of($skills)->make(true);
    }

    public function getDataTableAttachments($id)
    {
        $attachments = EmployeeAttachment::where('emp_id', $id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableEmergencyContacts($id)
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', $id)->get();
        return DataTables::of($contacts)->make(true);
    }
}
