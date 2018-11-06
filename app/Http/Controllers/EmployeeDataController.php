<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use App\Department;
use App\EmployeeMainPosition;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use App\Roles;


class EmployeeDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addEmployee()
    {   
        $countries = Countries::all();
        $roles = Roles::all();

        return view('pages.admin.register-employee', compact('countries','roles'));
    }
   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email|max:255|unique:employee_info',
            'contact_no' => 'required|string|max:30',
            'address' => 'required|max:250',
            'ic_no' => 'required|string|max:20',
            'gender' => 'required',
            'maritial_status' => 'required',
            'race' => 'required|string|30',
            'countries' => 'required',
            'total_child' => 'required|numeric',
            'driver_license_number' => 'required|max:50',
            'epf_no' => 'required|max:50',
            'roles' => 'required',
            'tax_no' => 'required|max:50',
        ]);
    }
  
    protected function insert(Request $request)
    {                
        $name = $request->input('name');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $address = $request->input('address');
        $ic_no = $request->input('ic_no');
        $gender = $request->input('gender');        
        $dob = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dobDate'))));
        $license_expiry_date= date('Y-m-d', strtotime(str_replace('-', '/', $request->input('licenseExpiryDate'))));  
        $marital_status = $request->input('marital_status');
        $race = $request->input('race');
        $total_child = $request->input('total_child');
        $driver_license_number = $request->input('driver_license_number');
        $epf_no = $request->input('epf_no');
        $tax_no = $request->input('tax_no');
        $role_id = Input::get('roles');        
        $citizenship = Input::get('countries');
        $created_by = auth()->user()->id;

        DB::insert('insert into employee_info 
        (name, email, contact_no, 
        address, ic_no, gender, dob, 
        marital_status, race, citizenship, 
        total_child,license_expiry_date, driver_license_number,  
        epf_no, tax_no, role_id, 
        created_by) 
        values
        (?,?,?,
        ?,?,?,?,
        ?,?,?,
        ?,?,?,
        ?,?,?,
        ?)',
        [$name, $email, $contact_no, 
        $address, $ic_no, $gender, $dob, 
        $marital_status, $race, $citizenship,
         $total_child, $license_expiry_date, $driver_license_number,  
         $epf_no, $tax_no, $role_id, 
         $created_by]);

        echo "Record inserted successfully<br/>";
        echo '<a href = "/insert">Click Here</a> to go back.';

    }

}
