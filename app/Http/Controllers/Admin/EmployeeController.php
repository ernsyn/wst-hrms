<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Country;
use App\Roles;
use App\Bank;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\Team;
use App\EmployeePosition;
use App\Company;
use App\Holiday;
use App\LeaveRequest;
use App\User;
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
use App\EmployeeGrade;
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\EmployeeWorkingDay;
use App\EmployeeAttendance;
use App\Media;
use App\EmployeeClockInOutRecord;
use App\Http\Services\LeaveService;
use App\Http\Requests\Admin\AddEmployee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    public function index()
    {
        // $userlist = User::orderBy('id', 'Desc')->get();
        // $employee_users = User::whereHas("roles", function($q){ $q->where("name", "employee"); })->get();
        // dd($employee_users[0]->employee->id);

        $employees = Employee::all();

        return view('pages.admin.employees.index', ['employees'=> $employees]);
    }

    public function dsplaySecurityGroup($id)
    {
        $employees = Employee::all();
        return view('pages.admin.employees.id.security-group', ['employees'=> $employees]);
    }

    public function display($id)
    {
        $employee = Employee::with('user')
        ->with(['employee_confirmed' => function($query) use ($id)
        {
            $query->where('status','=','confirmed-employment')
            ->where ('emp_id','=',$id);
        }])
        ->find($id);

        $userMedia = DB::table('users')
        ->join('medias', 'users.profile_media_id', '=', 'medias.id')
        ->join('employees', 'employees.user_id', '=', 'users.id')
        ->select('medias.*')
        ->where('employees.id', $id)
        ->first();

        // dd($userMedia);

        // $bank_list = Bank::all();
        // $cost_centre = CostCentre::all();
        // $department = Department::all();
        // $team = Team::all();
        // $position = EmployeePosition::all();
        // $grade = EmployeeGrade::all();
        // $branch = Branch::all();
        // $countries = Country::all();
        // $companies = Company::all();

        return view('pages.admin.employees.id', ['employee' => $employee,'userMedia' => $userMedia]);
    }

    public function postEditProfilePicture(Request $request, $emp_id)
    {
        $pictureData = $request->validate([
            'attachment' => 'required|max:2000000|regex:/^data:image/'
        ],
        [
            'attachment.max' => 'The file size may not be greater than 2MB.'
        ]);

        $picture_data_url = $pictureData['attachment'];
        $attach = self::processBase64DataUrl($picture_data_url);
        $updatepictureData['category']= 'employee-picture';
        $updatepictureData['mimetype']= $attach['mime_type'];
        $updatepictureData['data']= $attach['data'];
        $updatepictureData['size']= $attach['size'];
        $updatepictureData['filename']= 'employee_'.($emp_id).'_'.date('Y-m-d_H:i:s').".".$attach['extension'];


        DB::transaction(function() use ($emp_id, $updatepictureData) {
            $user = Employee::find($emp_id)->user;

            $oldProfileMedia = $user->profile_media;

            if(!empty($oldProfileMedia)) {
                $user->profile_media()->dissociate();
                $user->save();

                $oldProfileMedia->delete();
            }

            $user->profile_media()->associate(Media::create($updatepictureData));
            $user->save();
        });

        return response()->json(['success'=>'Profile Picture was successfully updated.']);
    }

    public function postEditProfile(Request $request, $id)
    {
        $profileUpdatedData = $request->validate([
            'ic_no' => 'required|numeric|unique:employees,ic_no,'.$id.',id',
            'code'=>'required|unique:employees,code,'.$id.',id',
            'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'gender' => 'required',
            'marital_status' => 'required',
            'race' => 'required|alpha',
            'total_children' => 'nullable|numeric',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'tax_no' => 'required|unique:employees,tax_no,'.$id.',id',
            'epf_no' => 'required|numeric|unique:employees,epf_no,'.$id.',id',
            'eis_no' => 'required|numeric|unique:employees,eis_no,'.$id.',id',
            'socso_no' => 'required|numeric|unique:employees,socso_no,'.$id.',id',
            'main_security_group_id'=>'',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'nationality' => 'required',
            // 'contact_no' => 'required|regex:/^[0-9]+-/',
        ],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
        ]);
        $profileUpdatedData['dob'] = implode("-", array_reverse(explode("/", $profileUpdatedData['dob'])));

        $profileUpdatedData['driver_license_expiry_date'] = implode("-", array_reverse(explode("/", $profileUpdatedData['driver_license_expiry_date'])));

        if($profileUpdatedData['driver_license_expiry_date']==='') {
            $profileUpdatedData['driver_license_expiry_date'] = null;
        }

        Employee::find($id)->update($profileUpdatedData);

        return response()->json(['success'=>'Profile was successfully updated.']);
    }

    public function add()
    {
        $countries = Country::orderBy('citizenship')->get();
        $roles = Roles::all();

        return view('pages.admin.employees.add', compact('countries','roles'));
    }

    public function changepassword()
    {
        return view('pages.admin.changepassword');
    }

    public function postChangePassword(Request $request, $id)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_new_password|same:confirm_new_password',
        ]);

        $employee = Employee::where('id', $id)->first();
        $current_password = $employee->user->password;
        $current_password = bcrypt($data['current_password']);


        if (!(Hash::check($data['current_password'],  $employee->user->password))) {
            response()->json(['errors'=> [
                'current_password' => ['The current password is incorrect.']
            ]], 422);
            return response()->json(['fail'=>'The current password is incorrect. Password was not successfully updated.']);
        } else {
            User::where('id', $employee->user->id)->update([
                'password' => bcrypt($data['new_password'])
            ]);
            return response()->json(['success'=>'Password was successfully updated.']);
        }
    }

    public function postResetPassword(Request $request, $id)
    {
        $data = $request->validate([
            'new_password' => 'required|min:5|required_with:confirm_new_password|same:confirm_new_password',
        ]);

        $employee = Employee::where('id', $id)->first();

        User::where('id', $employee->user->id)->update([
            'password' => bcrypt($data['new_password'])
        ]);
        return response()->json(['success'=>'Password was successfully reset.']);
    }

//     {
//         $departmentData = $request->validate([
//             'name' => 'required|unique:departments,name,NULL,id,deleted_at,NULL'

//         ]);
//         Department::create($departmentData);
//         return redirect()->route('admin.settings.departments')->with('status', 'Department has successfully been added.');
//     }

// }
    public function postChangePasswordEmployee(Request $request)
    {
        $data = $request->validate([
            // 'current_password' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_password|same:confirm_new_password',
        ]);
        return redirect()->route('admin.employees')->with('status', 'Employee successfully added!');
        $id = auth()->user()->name;
      //  dd($id);
        $current_password = Auth::user()->password;
        $current_password = bcrypt($data['current_password']);

        if (!(Hash::check($data['current_password'], Auth::user()->password))) {
            response()->json(['errors'=> [
                'current_password' => ['The current password is incorrect.']
            ]], 422);
            return redirect()->route('admin.employees')->with('status', 'Employee successfully added!');
        } else {
            User::where('id',$id)->update([
                'password' => bcrypt($data['new_password'])
            ]);
            return redirect()->route('admin.employees')->with('status', 'Employee successfully added!');
        }
    }

    public function postToggleRoleAdmin(Request $request, $id)
    {
        $data = $request->validate([
            // 'current_password' => 'required',
            'assign_remove' => 'required',
        ]);

        $employee = Employee::where('id', $id)->first();
        switch ($data['assign_remove']) {
            case "assign":
                $employee->user->assignRole('admin');
                break;
            case "remove":
                $employee->user->removeRole('admin');
                break;
        }

        return response()->json(['success'=>'Employee roles were successfully updated.']);
    }

    // SECTION: Data Tables

    public function getDataTableDependents($id)
    {
        $dependents = EmployeeDependent::where('emp_id', $id)->get();

        return DataTables::of($dependents)
        ->editColumn('dob', function ($dependent) {
            return date('d/m/Y', strtotime($dependent->dob) );
        })
        ->editColumn('alt_dob', function ($dependent) {
            return date('Y-m-d', strtotime($dependent->dob) );
        })
        ->make(true);
    }

    public function getDataTableImmigrations($id)
    {
        $immigrations = EmployeeImmigration::where('emp_id', $id)->get();

        return DataTables::of($immigrations)
        ->editColumn('issued_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->issued_date) );
        })
        ->editColumn('expiry_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->expiry_date) );
        })
        ->editColumn('alt_issued_date', function ($immigration) {
            return date('Y-m-d', strtotime($immigration->issued_date) );
        })
        ->editColumn('alt_expiry_date', function ($immigration) {
            return date('Y-m-d', strtotime($immigration->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableVisas($id)
    {
        $visas = EmployeeVisa::where('emp_id', $id)->get();
        return DataTables::of($visas)
        ->editColumn('issued_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->issued_date) );
        })
        ->editColumn('expiry_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->expiry_date) );
        })
        ->editColumn('alt_issued_date', function ($visa) {
            return date('Y-m-d', strtotime($visa->issued_date) );
        })
        ->editColumn('alt_expiry_date', function ($visa) {
            return date('Y-m-d', strtotime($visa->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableJobs($id)
    {
        $jobs = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', $id)->get();
        return DataTables::of($jobs)
        ->editColumn('start_date', function ($job) {
            return date('d/m/Y', strtotime($job->start_date) );
        })
        ->editColumn('alt_start_date', function ($job) {
            return date('Y-m-d', strtotime($job->start_date) );
        })
        ->make(true);
    }

    public function getDataTableBankAccounts($id)
    {
        $banks = EmployeeBankAccount::where('emp_id', $id)->get();
        return DataTables::of($banks)->make(true);
    }


    public function getDataTableExperiences($id)
    {
        $experiences = EmployeeExperience::where('emp_id', $id)->get();
        return DataTables::of($experiences)
        ->editColumn('start_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->start_date) );
        })
        ->editColumn('end_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->end_date) );
        })
        ->editColumn('alt_start_date', function ($experience) {
            return date('Y-m-d', strtotime($experience->start_date) );
        })
        ->editColumn('alt_end_date', function ($experience) {
            return date('Y-m-d', strtotime($experience->end_date) );
        })
        ->make(true);
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
        $attachments = EmployeeAttachment::with('medias')->where('emp_id', $id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableEmergencyContacts($id)
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', $id)->get();
        return DataTables::of($contacts)->make(true);
    }

    public function getDataTableReportTo($id)
    {
        $reportTos = EmployeeReportTo::with('employee_report_to.user')->where('emp_id', $id)->get();
        return DataTables::of($reportTos)->make(true);
    }

    public function getDataTableMainSecurityGroup($id)
    {
        $employee = Employee::with('security_groups')->where('emp_id', $id)->get();
        return DataTables::of($employee)->make(true);
    }

    public function getDataTableSecurityGroup($id)
    {
        $security_groups = EmployeeSecurityGroup::with('security_groups')->where('emp_id', $id)->get();
        return DataTables::of($security_groups)->make(true);
    }

    protected function postAdd(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'media_id' => '',
            'attachment' => '',
            'attach' => 'nullable|max:2000000|regex:/^data:image/',

            'code'=>'required|unique:employees',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'company_id' => 'required',
            'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'gender' => 'required',
            'race' => 'required|alpha',
            'nationality' => 'required',
            'marital_status' => 'required',
            'total_children' => 'nullable|numeric',
            'ic_no' => 'required|unique:employees,ic_no|numeric',
            'tax_no' => 'required|unique:employees,tax_no',
            'epf_no' => 'required|unique:employees,epf_no|numeric',
            'eis_no' => 'required|unique:employees,eis_no|numeric',
            'socso_no' => 'required|unique:employees,socso_no|numeric',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'main_security_group_id'=>'nullable'
        ],
        [
            'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.',
            'attach.max' => 'The file size may not be greater than 2MB.'
        ]);

        $attachment_data_url = $validated['attach'];


        DB::transaction(function () use ($attachment_data_url, $validated) {
            // $validatedUserData['profile_media_id'] = $media_id;
            // $validatedUserData['profile_media_id'] = $mediaData->id;

            $validatedUserData['name'] = $validated['name'];
            $validatedUserData['email'] = $validated['email'];
            $validatedUserData['password'] = Hash::make($validated['password']);

            $validatedEmployeeData['code'] = $validated['code'];
            $validatedEmployeeData['contact_no'] = $validated['contact_no'];
            $validatedEmployeeData['address'] = $validated['address'];
            $validatedEmployeeData['address2'] = $validated['address2'];
            $validatedEmployeeData['address3'] = $validated['address3'];
            $validatedEmployeeData['company_id'] = $validated['company_id'];
            $validatedEmployeeData['dob'] = implode("-", array_reverse(explode("/", $validated['dob'])));
            $validatedEmployeeData['gender'] = $validated['gender'];
            $validatedEmployeeData['race'] = $validated['race'];
            $validatedEmployeeData['nationality'] = $validated['nationality'];
            $validatedEmployeeData['marital_status'] = $validated['marital_status'];
            $validatedEmployeeData['total_children'] = $validated['total_children'];
            $validatedEmployeeData['ic_no'] = $validated['ic_no'];
            $validatedEmployeeData['tax_no'] = $validated['tax_no'];
            $validatedEmployeeData['epf_no'] = $validated['epf_no'];
            $validatedEmployeeData['eis_no'] = $validated['eis_no'];
            $validatedEmployeeData['socso_no'] = $validated['socso_no'];
            $validatedEmployeeData['driver_license_no'] = $validated['driver_license_no'];
            $validatedEmployeeData['driver_license_expiry_date'] = implode("-", array_reverse(explode("/", $validated['driver_license_expiry_date'])));
            if ($validatedEmployeeData['driver_license_expiry_date'] ==='') {
                $validatedEmployeeData['driver_license_expiry_date'] = null;
            }
            $validatedEmployeeData['main_security_group_id'] = $validated['main_security_group_id'];

            // $validatedEmployeeData = $request->validate([
            // ]);
            // dd($validatedEmployeeData);

            $user = User::create($validatedUserData);
            $user->assignRole('employee');

            if (!empty($attachment_data_url)) {
                $attach = self::processBase64DataUrl($attachment_data_url);

                $profileMedia = Media::create([
                    'category' => 'employee-profile',
                    'mimetype' => $attach['mime_type'],
                    'data' => $attach['data'],
                    'size' => $attach['size'],
                    'filename' => 'employee__'.date('Y-m-d_H:i:s').".".$attach['extension']
                ]);

                $user->profile_media()->associate($profileMedia);
                $user->save();
            }

            $validatedEmployeeData['user_id'] = $user->id;
            $validatedEmployeeData['created_by'] = auth()->user()->name;
            $employee = Employee::create($validatedEmployeeData);
        });

        return redirect()->route('admin.employees')->with('status', 'Employee was successfully added!');
    }


    // SECTION: Add
    public function postEmergencyContact(Request $request, $id)
    {
        $emergencyContactData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
        ]);
        $emergencyContactData['created_by'] = auth()->user()->name;
        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);

        $employee = Employee::find($id);
        $employee->employee_emergency_contacts()->save($emergencyContact);

        return response()->json(['success'=>'Emergency Contact was successfully added']);
    }

    public function postDependent(Request $request, $id)
    {
        $dependentData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentData['dob'] = implode("-", array_reverse(explode("/", $dependentData['dob'])));
        $dependentData['created_by'] = auth()->user()->name;
        $dependent = new EmployeeDependent($dependentData);

        $employee = Employee::find($id);
        $employee->employee_dependents()->save($dependent);

        return response()->json(['success'=>'Dependent was successfully added']);
    }

    public function postImmigration(Request $request, $id)
    {
        $immigrationData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'issued_by' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required'
        ]);
        $immigrationData['issued_date'] = implode("-", array_reverse(explode("/", $immigrationData['issued_date'])));
        $immigrationData['expiry_date'] = implode("-", array_reverse(explode("/", $immigrationData['expiry_date'])));
        $immigrationData['created_by'] = auth()->user()->name;
        $immigration = new EmployeeImmigration($immigrationData);

        $employee = Employee::find($id);
        $employee->employee_immigrations()->save($immigration);

        return response()->json(['success'=>'Immigration was successfully added']);
    }

    public function postVisa(Request $request, $id)
    {
        $visaData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            'issued_by' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required',
            'family_members' => 'required'
        ]);
        $visaData['issued_date'] = implode("-", array_reverse(explode("/", $visaData['issued_date'])));
        $visaData['expiry_date'] = implode("-", array_reverse(explode("/", $visaData['expiry_date'])));
        $visaData['created_by'] = auth()->user()->name;
        $visa = new EmployeeVisa($visaData);

        $employee = Employee::find($id);
        $employee->employee_visas()->save($visa);

        return response()->json(['success'=>'Visa was successfully added']);
    }

    public function postJob(Request $request, $id)
    {
        // Add a new job
        $jobData = $request->validate([
            'basic_salary' => 'required|numeric',
            'cost_centre_id' => 'required',
            'department_id' => 'required',
            'team_id' => 'required',
            'emp_mainposition_id' => 'required',
            'emp_grade_id' => 'required',
            'remarks' => '',
            'branch_id' => 'required',
            'start_date' => 'required',
            'status' => 'required',
        ]);
        $jobData['start_date'] = implode("-", array_reverse(explode("/", $jobData['start_date'])));
        $jobData['created_by'] = auth()->user()->name;
        DB::transaction(function() use ($jobData, $id) {
            $currentJob = EmployeeJob::where('emp_id', $id)->whereNull('end_date')->first();
            if(!empty($currentJob)) {
                if ($jobData['status']  == "confirmed-employment") {
                    Employee::where('id', $id)
                    ->update(array('confirmed_date'=> ($jobData['start_date'])));
                    $currentJob->update(['end_date'=> date("Y-m-d", strtotime($jobData['start_date']))]);
                    LeaveService::onJobEnd($id, $jobData['start_date'], $currentJob->emp_grade_id);


                } else {
                    $currentJob->update(['end_date'=> date("Y-m-d", strtotime($jobData['start_date']))]);
                    LeaveService::onJobEnd($id, $jobData['start_date'], $currentJob->emp_grade_id);
                     }
            } else {
                $jobData['status']  = "probationer";
            }

            Employee::where('id', $id)->update(array('basic_salary'=> ($jobData['basic_salary'])));
            Employee::where('id', $id)->update(array('resignation_date'=> null));
            $employee = Employee::find($id);
            $employee->employee_jobs()->save(new EmployeeJob($jobData));
            LeaveService::onJobStart($id, $jobData['start_date'], (int)$jobData['emp_grade_id']);
        });

        return response()->json(['success'=>'Job was successfully added']);
    }

    public function postResign(Request $request, $id) {

        $jobData = $request->validate([

            'resignation_date' => 'required',
        ]);

        $currentJob = EmployeeJob::where('emp_id', $id)
            ->whereNull('end_date')->first();
        $currentDate = date("Y-m-d");
        LeaveService::onJobEnd($id, $currentDate, $currentJob->emp_grade_id);
        $jobData['resignation_date'] = implode("-", array_reverse(explode("/", $jobData['resignation_date'])));

        Employee::where('id', $id)->update(array('resignation_date'=> ($jobData['resignation_date'])));
        $currentJob->update(array('end_date'=> ($jobData['resignation_date'])));
        $currentJob->update(array('status'=> 'Resigned'));
        return response()->json(['success'=>'Job was successfully added']);


        // $currentJob = EmployeeJob::where('emp_id', $id)
        //     ->whereNull('end_date')->first();

        // $currentDate = date("Y-m-d");

        // if(!empty($currentJob)) {

        // $jobs = EmployeeJob::where('emp_id', $id)
        // ->whereNull('end_date')->first();
        // $newJobs = $jobs->replicate();
        // $newJobs['status']  = 'Resigned';
        // $newJobs-> save();

        // $currentJob->update(['end_date'=> $currentDate ]);
        // LeaveService::onJobEnd($id, $currentDate, $currentJob->emp_grade_id);
        // return response()->json(['success'=>'Employee Resignation Date updated']);
        // }


    }

    public function postBankAccount(Request $request, $id)
    {
        $bankAccountData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric',
            'acc_status' => 'required'
        ]);
        $bankAccountData['created_by'] = auth()->user()->name;
        $bankAccount = new EmployeeBankAccount($bankAccountData);

        $employee = Employee::find($id);
        $employee->employee_bank_accounts()->save($bankAccount);

        return response()->json(['success'=>'Bank Account was successfully added']);
    }

    public function postCompany(Request $request, $id)
    {
        $experienceData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'notes'=>''
        ]);
        $experienceData['start_date'] = implode("-", array_reverse(explode("/", $experienceData['start_date'])));
        $experienceData['end_date'] = implode("-", array_reverse(explode("/", $experienceData['end_date'])));
        $experienceData['created_by'] = auth()->user()->name;
        $experience = new EmployeeExperience($experienceData);

        $employee = Employee::find($id);
        $employee->employee_experiences()->save($experience);

        return response()->json(['success'=>'Experience was successfully added']);
    }

    public function postEducation(Request $request, $id)
    {
        $educationData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer',
            'end_year' => 'required|digits:4|integer',
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|numeric|between:0,4.00',
            'description' => 'nullable'
        ]);
        $educationData['created_by'] = auth()->user()->name;
        $education = new EmployeeEducation($educationData);

        $employee = Employee::find($id);
        $employee->employee_educations()->save($education);

        return response()->json(['success'=>'Education was successfully added']);
    }

    public function postSkill(Request $request, $id)
    {
        $skillData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required',
            'competency' => 'required'
        ]);
        $skillData['created_by'] = auth()->user()->name;
        $skill = new EmployeeSkill($skillData);

        $employee = Employee::find($id);
        $employee->employee_skills()->save($skill);

        return response()->json(['success'=>'Skill was successfully added']);
    }


    public function postAttachment(Request $request, $id)
    {
        $attachmentData = $request->validate([
            'name' => 'required',
            'notes' => 'required',
            'media_id' => '',
            'attachment' => 'required'
        ]);

        $attachment_data_url = null;
        if (array_key_exists('attachment', $attachmentData)) {
            $attachment_data_url = $attachmentData['attachment'];
            $attach = self::processBase64DataUrl($attachment_data_url);
            $mediaData = Media::create([
                'category' => 'employee-attachment',
                'mimetype' => $attach['mime_type'],
                'data' => $attach['data'],
                'size' => $attach['size'],
                'filename' => 'employee_'.($id).'_'.date('Y-m-d_H:i:s').".".$attach['extension']
            ]);
            $attachmentData['media_id'] = $mediaData->id;
        }


        $attachmentData['created_by'] = auth()->user()->name;
        $attachment = new EmployeeAttachment($attachmentData);

        $employee = Employee::find($id);
        $employee->employee_attachments()->save($attachment);

        return response()->json(['success'=>'Attachment was successfully added']);
    }

    private static function processBase64DataUrl($dataUrl)
    {
        $parts = explode(',', $dataUrl);

        preg_match('#data:(.*?);base64#', $parts[0], $matches);
        $mimeType = $matches[1];
        $extension = explode('/', $mimeType)[1];

        $data = $parts[1];

        return [
            'data' => $data,
            'mime_type' => $mimeType,
            'size' => mb_strlen($data),
            'extension' => $extension
        ];
    }

    // SECTION: Employee Working Day Setup
    public function postWorkingDay(Request $request, $id)
    {
        $workingDayData = $request->validate([
            'monday' => 'required|in:full,half,off,rest',
            'tuesday' => 'required|in:full,half,off,rest',
            'wednesday' => 'required|in:full,half,off,rest',
            'thursday' => 'required|in:full,half,off,rest',
            'friday' => 'required|in:full,half,off,rest',
            'saturday' => 'required|in:full,half,off,rest',
            'sunday' => 'required|in:full,half,off,rest',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
       
        
        ]);
        $workingDaysData['is_template'] = false;
        $workingDaysData['created_by'] = auth()->user()->name;    //error
       
        $workingDay = new EmployeeWorkingDay($workingDayData);

        $employee = Employee::find($id);
        $employee->working_day()->save($workingDay);

        return response()->json(['success' => 'Working Day was successfully added']);
    }

    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayUpdateData = $request->validate([
            'monday' => 'required|in:full,half,off,rest',
            'tuesday' => 'required|in:full,half,off,rest',
            'wednesday' => 'required|in:full,half,off,rest',
            'thursday' => 'required|in:full,half,off,rest',
            'friday' => 'required|in:full,half,off,rest',
            'saturday' => 'required|in:full,half,off,rest',
            'sunday' => 'required|in:full,half,off,rest',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
        ]);
        $workingDayUpdateData['is_template'] = false;
        $workingDayUpdateData['created_by'] = auth()->user()->name;
        EmployeeWorkingDay::where('emp_id', $id)->update($workingDayUpdateData);

        return response()->json(['success'=>'Working Day was successfully updated.']);
    }

    public function getWorkingDay($id)
    {
        $working_day = EmployeeWorkingDay::templates()->where('id', $id)->get();
        return response()->json($working_day);
    }

    public function getEmployeeWorkingDay($emp_id)
    {
        $working_day = EmployeeWorkingDay::where('emp_id', $emp_id)->get();
        return response()->json($working_day);
    }

    public function getReportToEmployeeList(Request $request, $id)
    {
        $pageLimit = $request->get("page_limit");
        $nameQuery = $request->get("q");
        $employees = Employee::with('user:id,name')
        ->whereHas('user', function ($q) use ($nameQuery) {
            $q->where('name', 'like', "%{$nameQuery}%");
        })
        ->where('id', '!=', $id)
        ->take($pageLimit)
        ->get(['id', 'code', 'user_id']);

        $employee_list = [];
        foreach($employees as $employee) {
            array_push($employee_list, [
                'id' => $employee->id,
                'name' => $employee->user->name,
                'code' => $employee->code
            ]);
        }
        return response()->json($employee_list);
    }

    public function postReportTo(Request $request, $id)
    {
        $reportToData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'report_to_level' =>'required|unique:employee_report_to,report_to_level,NULL,id,deleted_at,NULL,emp_id,'.$id,
            'kpi_proposer' => 'nullable',
            'notes' => 'nullable',
        ]);

        if($request->get('kpi_proposer') == null){
            $reportToData['kpi_proposer'] = 0;
        } else {
            $reportToData['kpi_proposer'] = request('kpi_proposer');
        }

        $employee_kpi_proposer = EmployeeReportTo::where('emp_id','=',$id)
        ->where('kpi_proposer', 1)->where('deleted_at','=',null)->count();

        if($request->kpi_proposer == 0){
            $reportToData['created_by'] = auth()->user()->name;
            $reportTo = new EmployeeReportTo($reportToData);
            $employee = Employee::find($id);
            $employee->report_tos()->save($reportTo);

            return response()->json(['success'=>'Report To was successfully added']);
        } else {
            if($employee_kpi_proposer == 0){
                $reportToData['created_by'] = auth()->user()->name;
                $reportTo = new EmployeeReportTo($reportToData);
                $employee = Employee::find($id);
                $employee->report_tos()->save($reportTo);

            return response()->json(['success'=>'Report To was successfully added']);
        } else {
            return response()->json(['fail'=>'KPI Proposer already exist']);
        }

        }
    }
        // $reportTo = new EmployeeReportTo($reportToData);
        // $employee = Employee::find($id);
        // $employee->report_tos()->save($reportTo);
        // return response()->json(['success'=>'Report To was successfully added']);

        // $employee_report_to_level_two = EmployeeReportTo::where('emp_id','=',$id)
        // ->where('report_to_level', 2)->count();

        // $employee_report_to_level_one = EmployeeReportTo::where('emp_id','=',$id)
        // ->where('report_to_level', 1)->count();


        // if($request->report_to_level ==1 ) {

        //     if ($employee_report_to_level_one == 0 ) {
        //         if($request->kpi_proposer == 0){
        //             $reportTo = new EmployeeReportTo($reportToData);
        //             $employee = Employee::find($id);
        //             $employee->report_tos()->save($reportTo);

        //             return response()->json(['success'=>'Report To was successfully added']);
        //         } else {
        //             if ($employee_kpi_proposer >= 0) {
        //                 return response()->json(['fail'=>'error kpi_proposer 1']);
        //             } else {
        //                 $reportTo = new EmployeeReportTo($reportToData);
        //                 $employee = Employee::find($id);
        //                 $employee->report_tos()->save($reportTo);

        //                 return response()->json(['success'=>'Report To was successfully added']);
        //             }
        //         }
        //     } else if ($employee_report_to_level_one == 1) {
        //         return response()->json(['fail'=>'You already have Level 1']);
        //     } else {
        //         return "error";
        //     }
        // } else if($request->report_to_level == 2) {
        //     $employee_report_to_level_two = EmployeeReportTo::where('emp_id','=',$id)
        //     ->where('report_to_level', 2)->count();
        //     $employee_kpi_proposer = EmployeeReportTo::where('emp_id','=',$id)
        //     ->where('kpi_proposer', 1)->count();

        //     if ($employee_report_to_level_two == 0 ) {
        //         if($request->kpi_proposer == 0) {
        //             $reportTo = new EmployeeReportTo($reportToData);
        //             $employee = Employee::find($id);
        //             $employee->report_tos()->save($reportTo);

        //             return response()->json(['success'=>'Report To was successfully added']);
        //         } else {
        //             if ($employee_kpi_proposer >= 0) {
        //                 return response()->json(['fail'=>'error kpi_proposer2']);
        //             } else {
        //                 $reportTo = new EmployeeReportTo($reportToData);
        //                 $employee = Employee::find($id);
        //                 $employee->report_tos()->save($reportTo);

        //                 return response()->json(['fail'=>'Report To was successfully added']);
        //             }
        //         }
        //     } else if($employee_report_to_level_two == 1) {
        //         return response()->json(['fail'=>'You already have Level 2']);
        //     } else {
        //         return response()->json(['fail'=>'Error']);
        //     }
        // }
    

    public function postSecurityGroup(Request $request, $id)
    {
        $securityGroupData = $request->validate([
            'security_group_id' => 'required|unique:employee_security_groups,security_group_id,NULL,id,deleted_at,NULL,emp_id,'.$id
        ]);
        $securityGroupData['created_by'] = auth()->user()->name;
        $securityGroup = new EmployeeSecurityGroup($securityGroupData);

        $employee = Employee::find($id);
        $employee->employee_security_groups()->save($securityGroup);

        return response()->json(['success'=>'Security Group was successfully updated.']);
    }

    public function postMainSecurityGroup(Request $request, $id)
    {
        $mainSecurityGroupData = $request->validate([
            'main_security_group_id' => 'required'
        ]);

        Employee::update(array('main_security_group_id' => $mainSecurityGroupData));
        return response()->json(['success'=>'Security Group was successfully updated.']);
    }

    // SECTION: Edit
    public function postEditEmergencyContact(Request $request, $emp_id, $id)
    {
        $emergencyContactUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
        ]);

        EmployeeEmergencyContact::find($id)->update($emergencyContactUpdatedData);
        return response()->json(['success'=>'Emergency Contact was successfully updated.']);
    }

    public function postEditDependent(Request $request, $emp_id, $id)
    {
        $dependentUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentUpdatedData['dob'] = implode("-", array_reverse(explode("/", $dependentUpdatedData['dob'])));

        EmployeeDependent::find($id)->update($dependentUpdatedData);
        return response()->json(['success'=>'Dependent was successfully updated.']);
    }

    public function postEditImmigration(Request $request, $emp_id, $id)
    {
        $immigrationUpdatedData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'issued_by' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required'
        ]);
        $immigrationUpdatedData['issued_date'] = implode("-", array_reverse(explode("/", $immigrationUpdatedData['issued_date'])));
        $immigrationUpdatedData['expiry_date'] = implode("-", array_reverse(explode("/", $immigrationUpdatedData['expiry_date'])));

        EmployeeImmigration::find($id)->update($immigrationUpdatedData);

        return response()->json(['success'=>'Immigration was successfully updated.']);
    }

    public function postEditVisa(Request $request, $emp_id, $id)
    {
        $visaUpdatedData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            'issued_by' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required',
            'family_members' => 'required'
        ]);
        $visaUpdatedData['issued_date'] = implode("-", array_reverse(explode("/", $visaUpdatedData['issued_date'])));
        $visaUpdatedData['expiry_date'] = implode("-", array_reverse(explode("/", $visaUpdatedData['expiry_date'])));

        EmployeeVisa::find($id)->update($visaUpdatedData);

        return response()->json(['success'=>'Visa was successfully updated.']);
    }

    public function postEditJob(Request $request, $emp_id, $id)
    {
        $jobData = $request->validate([
            'branch_id' => 'required',
            'emp_mainposition_id' => 'required',
            'department_id' => 'required',
            'team_id' => 'required',
            'cost_centre_id' => 'required',
            'emp_grade_id' => 'required',
            'start_date' => 'required',
            'basic_salary' => 'required',
            'remarks' => '',
            'status' => 'required'
        ]);
        $jobData['start_date'] = implode("-", array_reverse(explode("/", $jobData['start_date'])));

        EmployeeJob::find($id)->update($jobData);

        return response()->json(['success'=>'Job was successfully updated.']);
    }

    public function postEditBankAccount(Request $request, $emp_id, $id)
    {
        $bankAccountUpdateData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric',
            'acc_status' => 'required'
        ]);

        EmployeeBankAccount::find($id)->update($bankAccountUpdateData);

        return response()->json(['success'=>'Bank Account was successfully updated.']);
    }

    public function postEditCompany(Request $request, $emp_id, $id)
    {
        $experienceUpdatedData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'notes' => ''
        ]);
        $experienceUpdatedData['start_date'] = implode("-", array_reverse(explode("/", $experienceUpdatedData['start_date'])));
        $experienceUpdatedData['end_date'] = implode("-", array_reverse(explode("/", $experienceUpdatedData['end_date'])));

        EmployeeExperience::find($id)->update($experienceUpdatedData);

        return response()->json(['success'=>'Experience was successfully updated.']);
    }

    public function postEditEducation(Request $request, $emp_id, $id)
    {
        $educationUpdatedData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'end_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|numeric|between:0,4.00',
            'description' => ''
        ]);

        EmployeeEducation::find($id)->update($educationUpdatedData);

        return response()->json(['success'=>'Education was successfully updated.']);
    }

    public function postEditSkill(Request $request, $emp_id, $id)
    {
        $skillUpdatedData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required',
            'competency' => 'required',
        ]);

        EmployeeSkill::find($id)->update($skillUpdatedData);

        return response()->json(['success'=>'Skill was successfully updated.']);
    }

    public function postEditReportTo(Request $request, $emp_id, $id)
    {
        $reportToUpdatedData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'report_to_level' =>'required|unique:employee_report_to,report_to_level,'.$id.',id,deleted_at,NULL,emp_id,'.$emp_id,
            'kpi_proposer' => 'nullable',
            'notes' => 'nullable',
        ]);

        if($request->get('kpi_proposer') == null){
            $reportToUpdatedData['kpi_proposer'] = 0;
        } else {
            $reportToUpdatedData['kpi_proposer'] = request('kpi_proposer');
        }

        $employee_kpi_proposer = EmployeeReportTo::where('emp_id','=',$emp_id)
        ->where('kpi_proposer', 1)->where('deleted_at','=',null)->count();

        if($request->kpi_proposer == 0){
            EmployeeReportTo::find($id)->update($reportToUpdatedData);
            return response()->json(['success'=>'Report To was successfully updated.']);
        } else if($employee_kpi_proposer == 0){
            EmployeeReportTo::find($id)->update($reportToUpdatedData);
            return response()->json(['success'=>'Report To was successfully updated.']);
        } else {
            return response()->json(['fail'=>'KPI Proposer already exist']);
        }
    }

    public function postEditAttachment(Request $request, $emp_id, $id)
    {
        $attachmentUpdatedData = $request->validate([
            'name' => 'required',
            'notes' => 'required'
        ]);

        EmployeeAttachment::find($id)->update($attachmentUpdatedData);

        return response()->json(['success'=>'Attachment was successfully updated.']);
    }


    //delete function
    public function deleteEmergencyContact(Request $request, $emp_id, $id)
    {
        EmployeeEmergencyContact::find($id)->delete();
        return response()->json(['success'=>'Emergency Contact was successfully deleted.']);
    }

    public function deleteDependent(Request $request, $emp_id, $id)
    {
        EmployeeDependent::find($id)->delete();
        return response()->json(['success'=>'Dependent was successfully deleted.']);
    }

    public function deleteImmigration(Request $request, $emp_id, $id)
    {
        EmployeeImmigration::find($id)->delete();
        return response()->json(['success'=>'Immigration was successfully deleted.']);
    }

    public function deleteVisa(Request $request, $emp_id, $id)
    {
        EmployeeVisa::find($id)->delete();
        return response()->json(['success'=>'Visa was successfully deleted.']);
    }

    public function deleteBankAccount(Request $request, $emp_id, $id)
    {
        EmployeeBankAccount::find($id)->delete();
        return response()->json(['success'=>'Bank Account was successfully deleted.']);
    }

    public function deleteExperience(Request $request, $emp_id, $id)
    {
        EmployeeExperience::find($id)->delete();
        return response()->json(['success'=>'Experience was successfully deleted.']);
    }

    public function deleteEducation(Request $request, $emp_id, $id)
    {
        EmployeeEducation::find($id)->delete();
        return response()->json(['success'=>'Education was successfully deleted.']);
    }

    public function deleteSkill(Request $request, $emp_id, $id)
    {
        EmployeeSkill::find($id)->delete();
        return response()->json(['success'=>'Skill was successfully deleted.']);
    }

    public function deleteAttachment(Request $request, $emp_id, $id)
    {
        EmployeeAttachment::find($id)->delete();
        return response()->json(['success'=>'Attachment was successfully deleted.']);
    }

    public function deleteReportTo(Request $request, $emp_id, $id)
    {
        EmployeeReportTo::find($id)->delete();
        return response()->json(['success'=>'Report To was successfully deleted.']);
    }

    public function deleteSecurityGroup(Request $request, $emp_id, $id)
    {
        EmployeeSecurityGroup::find($id)->delete();
        return response()->json(['success'=>'Security Group was successfully deleted.']);
    }

    public function postDisapproved(Request $request)
    {
        $id = $request->input('id');
        $emp_id = $request->input('emp_id');
        $leave_type_id = $request->input('leave_type_id');
        $total_days =$request->input('total_days');

        $leaveAllocationData1 = LeaveAllocation::select ('spent_days')->where('emp_id',$emp_id)
        ->where('leave_type_id',$leave_type_id)->first()->spent_days;

        $leaveAllocationData = number_format($leaveAllocationData1,1);
        $total_days =number_format($total_days,1);
        $leaveAllocationDataEntry = $leaveAllocationData - $total_days;

        LeaveRequest::where('id',$id)->update(array('status' => 'rejected'));
        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();

        $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
        ->where('leave_type_id',$leave_type_id)
        ->update(array('spent_days'=>$leaveAllocationDataEntry));

        return redirect()->route('leaverequest');
    }

    public function ajaxGetAttendances(Request $request, $id)
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $attendances = EmployeeAttendance::where('emp_id', $id)
        ->whereDate('date', '>=', $startOfMonth)
        ->whereDate('date', '<=', $endOfMonth)->get();

        return $attendances;
    }
}
