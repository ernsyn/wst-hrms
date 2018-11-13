<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Department;
use App\Roles;
use App\EmployeeMainPosition;
use App\User;
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


        $user = User::create($input);
        $user->assignRole('employee');


        return view('home');

    }

}
