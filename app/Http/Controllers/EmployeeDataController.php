<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Department;
use App\Roles;
use App\EmployeeMainPosition;
use App\User;
use App\Employee;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Hash;



class EmployeeDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addEmployee()
    {   
        $countries = Country::all();
        $roles = Roles::all();

        return view('pages.admin.register-employee', compact('countries','roles'));
    }
   
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('pages.admin.user-list',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email|max:255|unique:employee_info',
            'contact_no' => 'required|string|max:30',
           
        ]);
    }
  

    protected function insert(Request $request)
    {                
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $contact_no = $request->input('contact_no');       
        $address = $request->input('address');
        $company_id = Input::get('company_id');
        $dob = $request->input('dob');       
        $gender = $request->input('gender');
        $race = $request->input('race');
        $nationality = $request->input('nationality');       
        $marital_status =  $request->input('marital_status');
        $total_children = $request->input('total_child');
        $ic_no = $request->input('ic_no');       
        $tax_no = $request->input('tax_no');
        $epf_no = $request->input('epf_no');
        $driver_license_no = $request->input('driver_license_number');       
        $driver_license_expiry_date = $request->input('driver_license_expiry_date');    
        $created_by = auth()->user()->id;
        $user = User::create($input);
        $user->assignRole('employee');
        
//$package = Packages::create($request->all());
//$employee =  new Employee();
// $employee->user_id = $user->id;
// $employee->address =$address;
// $employee->company_id =$company_id;
// $employee->contact_no =$contact_no;
// $employee->dob=$dob;
// $employee->gender =$gender;
// $employee->race =$race;
// $employee->nationality=$nationality;

// $employee->marital_status=$marital_status;
// $employee->total_children =$total_children;
// $employee->ic_no =$ic_no;
// $employee->tax_no=$tax_no;


// $employee->epf_no=$epf_no;
// $employee->driver_license_no =$driver_license_no;
// $employee->driver_license_expiry_date =$driver_license_expiry_date;
// $employee->created_by=$created_by;
// Populate other fields

$employee =Employee::create($request->all());
$employee->save();


        return view('home');

    }

}
