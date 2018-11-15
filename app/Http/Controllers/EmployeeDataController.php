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
        // $socso_no = $request->input('socso_no');       
        // $insurance_no = $request->input('insurance_no');
        // $pcb_group = $request->input('pcb_group');
        $driver_license_no = $request->input('driver_license_number');       
        $driver_license_expiry_date = $request->input('driver_license_expiry_date');
        // $basic_salary = $request->input('basic_salary');
        // $confirmed_date = $request->input('confirmed_date');         
        $created_by = auth()->user()->id;
        // $code = $request->input('code');
        // $updated_by =$request->input('updated_by');


        $user = User::create($input);
        $user->assignRole('employee');
        
//$package = Packages::create($request->all());
        $itinerary =  new Employee();
$itinerary->user_id = $user->id;
$itinerary->address =$address;
$itinerary->company_id =$company_id;
$itinerary->contact_no =$contact_no;
$itinerary->dob=$dob;
$itinerary->gender =$gender;
$itinerary->race =$race;
$itinerary->nationality=$nationality;

$itinerary->marital_status=$marital_status;
$itinerary->total_children =$total_children;
$itinerary->ic_no =$ic_no;
$itinerary->tax_no=$tax_no;


$itinerary->epf_no=$epf_no;
$itinerary->driver_license_no =$driver_license_no;
$itinerary->driver_license_expiry_date =$driver_license_expiry_date;
$itinerary->created_by=$created_by;
// Populate other fields
$itinerary->save();


        return view('home');

    }

}
