<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Constants\PermissionConstant;
use App\Enums\EpfCategoryEnum;
use App\Enums\PCBGroupEnum;
use App\Enums\PaymentViaEnum;
use App\Enums\PaymentRateEnum;
use App\Enums\SocsoCategoryEnum;
use App\Helpers\AccessControllHelper;
use App\Helpers\DateHelper;
use App\Helpers\PayrollHelper;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Area;
use App\CostCentre;
use App\Country;
use App\Department;
use App\EmploymentStatus;
use App\Roles;
use App\User;
use App\Employee;
use App\EmployeeAsset;
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
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\EmployeeWorkingDay;
use App\EmployeeAttendance;
use App\Media;
use App\SecurityGroup;
use App\Imports\UserImport;
use App\Mail\NewUserMail;
use App\EmployeePosition;
use App\CompanyAsset;
use App\LeaveAllocation;
use App\Helpers\FilterHelper;
use App\LeaveRequest;
use App\LeaveRequestApproval;
use App\EmployeeJobStatus;
use App\AssetAttach;
use App\Category;
use App\DisciplineAttach;
use App\EmployeeDisciplinary;
use Illuminate\Support\Facades\Storage;
use App\EmpReportToPP;
use App\PayrollPeriod;
use App\Section;
use PDF;
use App\Enums\EmployeeTableHeaderEnum;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\JobAttach;
use App\Branch;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Employee List
    public function index()
    {
        //         $employees = Employee::all();
        //         return view('pages.admin.employees.index', ['employees'=> $employees]);
        $costCentres = FilterHelper::getCostCentre();
        $departments = FilterHelper::getDepartment();
        $sections = FilterHelper::getSection();
        $positions = FilterHelper::getPosition();
        $teams = FilterHelper::getTeam();
        $categories = FilterHelper::getCategory();
        $areas = FilterHelper::getArea();
        $grades = FilterHelper::getGrade();
        $bankCodes = FilterHelper::getBankCode();
        return view('pages.admin.employees.index', ['costCentres'=> $costCentres, 'departments' => $departments,
            'sections' => $sections, 'positions' => $positions, 'teams' => $teams, 'categories' => $categories,
            'areas' => $areas, 'grades' => $grades, 'bankCodes' => $bankCodes
        ]);
    }
    
    public function getDataTableEmployees(Request $request)
    {
        $result = FilterHelper::getEmployees($request);
        return Datatables::of($result[0])->with([
            'recordsTotal' => $result[1],
            'recordsFiltered' => $result[1],
            'data' => $result[2]
        ])->make(true);
    }
    
    public function assetList()
    {
        $employeeAssets = DB::table('users')
        ->join('employees','users.id', '=', 'employees.user_id')
        ->join('employee_assets','employees.id', '=', 'employee_assets.emp_id')
        ->select('users.name as name', 'employee_assets.emp_id as emp_id')
        ->groupby('employee_assets.emp_id')
        ->get();
        $items = CompanyAsset::all();
        
        return view('pages.admin.employees.assetlist', ['employeeAssets'=> $employeeAssets, 'items' => $items]);
    }
    
    
    public function assetDisplay($id)
    {
        //Log::debug("Asset display");
        //Log::debug($id);
        $employee = Employee::with('user')
        ->find($id);
        
        $details = DB::table('employees')
        ->leftjoin('sections','employees.section_id','=','sections.id')
        ->leftjoin('departments','employees.department_id','=','departments.id')
        ->leftjoin('employee_positions','employees.position_id','=','employee_positions.id')
        ->leftjoin('areas','employees.area_id','=','areas.id')
        ->leftjoin('branches','employees.branch_id','=','branches.id')
        ->leftjoin('cost_centres','employees.cost_centre_id','=','cost_centres.id')
        ->select('sections.name as section','departments.name as department','employee_positions.name as position','areas.name as area','branches.name as branch','cost_centres.name as cost_centre')
        ->where('employees.id',$id)
        ->first();

        $userMedia = DB::table('employees')
        ->join('medias', 'employees.profile_media_id', '=', 'medias.id')
        ->select('medias.*')
        ->where('employees.id', $id)
        ->first();
        $roles = AccessControllHelper::getRoles();
        $items = CompanyAsset::all();
        return view('pages.admin.employees.assetid', ['employee' => $employee, 'userMedia' => $userMedia, 'roles' => $roles, 'items' => $items,'details' => $details]);          
    }
    
    //Add Employee
    public function add()
    {
        $countries = Country::orderBy('citizenship')->get();
        $roles = Roles::all();
        $epfCategory = EpfCategoryEnum::choices();
        $pcbGroup = PCBGroupEnum::choices();
        $socsoCategory = SocsoCategoryEnum::choices();
        $paymentviaGroup = PaymentViaEnum::choices();
        $paymentrateGroup = PaymentRateEnum::choices();
        $categories = Category::all();
        
        return view('pages.admin.employees.add', compact('countries','roles','epfCategory','pcbGroup','socsoCategory','paymentviaGroup','paymentrateGroup','categories'));
    }
    
    public function display($id)
    {
        $employee = Employee::with('user')
        ->find($id);
        
        if(isset($employee->join_company_date) && isset($employee->resignation_date)) {
            $employee->serviceYear = \Carbon\Carbon::parse($employee->join_company_date)->diff($employee->resignation_date)->format('%y yr, %m mth');
        } else if (isset($employee->join_company_date) && !isset($employee->resignation_date)) {
            $employee->serviceYear = \Carbon\Carbon::parse($employee->join_company_date)->diff(\Carbon\Carbon::now())->format('%y yr %m mth');
        }
        
        $userMedia = DB::table('employees')
        ->join('medias', 'employees.profile_media_id', '=', 'medias.id')
        ->select('medias.*')
        ->where('employees.id', $id)
        ->first();
        
        $securityGroup = DB::table('security_groups')
        ->join('employees','security_groups.company_id','=','employees.company_id')
        ->select('security_groups.*')
        ->where('employees.id',$id)
        ->get();
        
        $details = DB::table('employees')
        ->leftjoin('sections','employees.section_id','=','sections.id')
        ->leftjoin('departments','employees.department_id','=','departments.id')
        ->leftjoin('employee_positions','employees.position_id','=','employee_positions.id')
        ->leftjoin('areas','employees.area_id','=','areas.id')
        ->leftjoin('branches','employees.branch_id','=','branches.id')
        ->leftjoin('cost_centres','employees.cost_centre_id','=','cost_centres.id')
        ->select('sections.name as section','departments.name as department','employee_positions.name as position','areas.name as area','branches.name as branch','cost_centres.name as cost_centre')
        ->where('employees.id',$id)
        ->first();
        
        $jobs = DB::table('employee_jobs')
        ->leftjoin('departments','employee_jobs.department_id','=','departments.id')
        ->leftjoin('employee_positions','employee_jobs.emp_mainposition_id','=','employee_positions.id')
        ->leftjoin('sections','employee_jobs.section_id','=','sections.id')
        ->leftjoin('branches','employee_jobs.branch_id','=','branches.id')
        ->leftjoin('cost_centres','employee_jobs.cost_centre_id','=','cost_centres.id')
        ->leftjoin('employee_job_status', 'employee_jobs.id', 'employee_job_status.emp_job_id')
        ->select('employee_jobs.id as id','employee_jobs.start_date as start_date', 'departments.name as department_name','employee_positions.name as position_name','sections.name as section_name','branches.name as branch_name','cost_centres.name as cost')
        ->where('employee_jobs.emp_id',$id)
        ->orderBy('employee_jobs.start_date')
        ->get();
        
        foreach($jobs as $job) {
            $statuses = '';
            $jobStatus = EmployeeJobStatus::where('emp_job_id', $job->id)->get();
            $i = 0;
            foreach($jobStatus as $status) {
                $statuses .= EmploymentStatus::find($status->status_id)->name;
                if($i < count($jobStatus)-1){
                    $statuses .= ', ';
                }
                $i++;
            }
            $job->status = $statuses;
        }
        
        $roles = AccessControllHelper::getRoles();
        $epfCategory = EpfCategoryEnum::choices();
        $pcbGroup = PCBGroupEnum::choices();
        $socsoCategory = SocsoCategoryEnum::choices();
        $paymentviaGroup = PaymentViaEnum::choices();
        $paymentrateGroup = PaymentRateEnum::choices();
        $items = CompanyAsset::all();
        $categories = Category::all();
        
        return view('pages.admin.employees.id', ['employee' => $employee, 'userMedia' => $userMedia, 'securityGroup' => $securityGroup, 'roles' => $roles, 'epfCategory' => $epfCategory, 'pcbGroup' => $pcbGroup, 'socsoCategory' => $socsoCategory, 'paymentviaGroup' => $paymentviaGroup,'paymentrateGroup' => $paymentrateGroup,'items' => $items,'categories' => $categories,'jobs'=> $jobs,'details' => $details]);
    }
    
    
    
    public function displayAttach(Request $request) 
    {
    
        $id=$request->id;
        $attachs = DB::table('asset_attachs')
        ->select('asset_attach','id')
        ->where('asset_id', $id)
        ->get();
        
		return $attachs;
    }

	public function displayDisciplineAttach(Request $request)
    {    
        $id = $request->id; 
        $attachs = DB::table('discipline_attachs')
        ->select('discipline_attach','id')
        ->where('discipline_id', $id)
        ->get();
        return $attachs;
    }
    
    
    public function securityGroupDisplay($id)
    {
        $securityGroup = DB::table('security_groups')
        ->join('employees','security_groups.company_id','=','employees.company_id')
        ->select('security_groups.*')
        ->where('employees.id',$id)
        ->get();
        
        return view('pages.admin.employees.id.security-group', ['securityGroup' => $securityGroup]);
    }
    
    public function postAddDiscipline(Request $request, $id)
    {
        $disciplineData = $request->validate([
            'discipline_title' => 'required',
            'discipline_desc' => 'required',
            'discipline_date' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'discipline_attach' => 'nullable'
        ]);
        
        $disciplineData['discipline_date'] = implode("-", array_reverse(explode("/", $disciplineData['discipline_date'])));
        $disciplineData['created_by'] = auth()->user()->id;
        $discipline= new EmployeeDisciplinary($disciplineData);
        $employee = Employee::find($id);
        $employee->emp()->save($discipline);
        
        
        if($request->hasFile('discipline_attach'))
        {
            $files = $request->file('discipline_attach');
            foreach($files as $file)
            {
                $path = $file->getClientOriginalName();
                $name = time() . '-' . $path;
                
                $attach = new DisciplineAttach();
                $attach->discipline_attach = $name;
                $attach->discipline_id = $discipline->id;
                $attach->save();
                $file->storeAs('public/emp_id_'. $id.'/discipline', $name);
            }
        }
        
        return response()->json(['success'=>'Disciplinary Issue was successfully added']);
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
    
    public function postEditProfilePicture(Request $request, $emp_id)
    {
        $pictureData = $request->validate([
            'attachment' => 'required|regex:/^data:image/'
        ]);
        
        $attach = $request->validate([
            'size' => 'nullable|max:2000000'
        ],
            [
                'size.max' => 'The file size may not be greater than 2MB.'
            ]);
        
        $picture_data_url = $pictureData['attachment'];
        $attach = self::processBase64DataUrl($picture_data_url);
        $updatepictureData['category']= 'employee-picture';
        $updatepictureData['mimetype']= $attach['mime_type'];
        $updatepictureData['data']= $attach['data'];
        $updatepictureData['size']= $attach['size'];
        $updatepictureData['filename']= 'employee_'.($emp_id).'_'.date('Y-m-d_H:i:s').".".$attach['extension'];
        
        DB::transaction(function() use ($emp_id, $updatepictureData) {
            $user = Employee::find($emp_id);
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
        $employee = Employee::find($id);
        $profileUpdatedData = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$employee->user_id.',id',
            'ic_no' => 'required|numeric|unique:employees,ic_no,'.$id.',id',
            'code'=>'required|unique:employees,code,'.$id.',id',
            'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'gender' => 'required',
            'marital_status' => 'required',
            'race' => 'required|alpha',
            'total_children' => 'required|numeric',
            'address' => 'required',
            'address2' => 'required_with:address3',
            'address3' => 'nullable',
            'postcode' => 'required|numeric',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'tax_no' => 'nullable|unique:employees,tax_no,'.$id.',id',
            'pcb_group' => 'required_with:tax_no',
            'epf_no' => 'nullable|numeric|unique:employees,epf_no,'.$id.',id',
            'epf_category' => 'required_with:epf_no',
            'eis_no' => 'nullable|numeric|unique:employees,eis_no,'.$id.',id',
            'socso_no' => 'required|numeric|unique:employees,socso_no,'.$id.',id',
            'socso_category' => 'required',
            'main_security_group_id'=>'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'nationality' => 'required',
            'personal_email' => 'required|email|unique:employees,personal_email,'.$id.',id',
            'spouse_name' => 'nullable',
            'spouse_ic' => 'nullable',
            'spouse_tax_no' => 'nullable',
            'payment_via' =>'required',
            'payment_rate' =>'required',
            'category_id' => 'required',
            
        ],
            [
                'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.'
            ]);
        $profileUpdatedData['dob'] = implode("-", array_reverse(explode("/", $profileUpdatedData['dob'])));
        
        $profileUpdatedData['driver_license_expiry_date'] = implode("-", array_reverse(explode("/", $profileUpdatedData['driver_license_expiry_date'])));
        
        if($profileUpdatedData['driver_license_expiry_date']==='') {
            $profileUpdatedData['driver_license_expiry_date'] = null;
        }
        
        // $security = SecurityGroup::select('company_id')->where('id','=',$request->main_security_group_id)->get();
        // $company_id =Employee::select('company_id')->where('id','=',$security)->get();
        // if ($security == $company_id)
        // {
        User::find($employee->user_id)->update($profileUpdatedData);
        Employee::find($id)->update($profileUpdatedData);
        
        return response()->json(['success'=>'Profile was successfully updated.']);
    }
    
    // else
    // {
    // return response()->json(['success'=>'Security Group Cannot Be Added.Please Select Security Group With Same Company ID']);
    // }
    
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
    
    public function postChangePasswordEmployee(Request $request)
    {
        $data = $request->validate([
            // 'current_password' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_password|same:confirm_new_password',
        ]);
        return redirect()->route('admin.employees')->with('status', 'Employee successfully added!');
        $id = auth()->user()->id;
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
        $jobs = EmployeeJob::with('main_position','department', 'team',
            'cost_centre', 'grade', 'branch', 'section', 'jobcompany')->where('emp_id', $id)->get();
        $jobs->load('job_status','job_attachs');
        
        foreach($jobs as $job){
            $mainPosition = EmployeePosition::find($job->emp_mainposition_id);
            if (isset($mainPosition)) {
                $job->main_position_name = $mainPosition->name;
            } else {
                $job->main_position_name = null;
            }
            $department = Department::find($job->department_id);
            if (isset($department)) {
                $job->department_name = $department->name;
            } else {
                $job->department_name = null;
            }
            $costCentre = CostCentre::find($job->cost_centre_id);
            if (isset($costCentre)) {
                $job->cost_centre_name = $costCentre->name;
            } else {
                $job->cost_centre_name = null;
            }
            $section = Section::find($job->section_id);
            if (isset($section)) {
                $job->section_name = $section->name;
            } else {
                $job->section_name = null;
            }
            $area = Area::find($job->branch->area_id);
            $job->area = $area->name;
            
            $statusArray = array();
            foreach($job->job_status as $status) {
                array_push($statusArray, EmploymentStatus::find($status->status_id)->name);
            }
            $job->status = $statusArray;
            
            $attachArray = array();
            foreach($job->job_attachs as $attach) {
                $attachment = JobAttach::find($attach->id)->job_attach;
                $attachlink = $attachment;
//                 $attachlink = ("/storage/emp_id_".$job['emp_id']."/job/".$attachment);
                array_push($attachArray, $attachlink);
            }
            $job->attach = $attachArray;
            
        }
        
        return DataTables::of($jobs)
//         ->editColumn('start_date', function ($job) {
//             if ($job->start_date !== null)
//                 return date('d/m/Y', strtotime($job->start_date) );
//         })
//         ->editColumn('alt_start_date', function ($job) {
//             if ($job->start_date !== null)
//                 return date('Y-m-d', strtotime($job->start_date) );
//         })
//         ->editColumn('end_date', function ($job) {
//             if ($job->end_date !== null)
//                 return date('d/m/Y', strtotime($job->end_date) );
//         })
//         ->editColumn('alt_end_date', function ($job) {
//             if ($job->end_date !== null)
//                 return date('Y-m-d', strtotime($job->end_date) );
//         })
        ->make(true);
    }
    
    public function getDataTableBankAccounts($id)
    {
        $banks = EmployeeBankAccount::where('emp_id', $id)->get();
        return DataTables::of($banks)->make(true);
    }
      
    public function getDataTableDiscipline($id)
    {

       $disciplines = EmployeeDisciplinary::where('emp_id','=', $id)->get();
        //Log::debug($assets);
        $data = array();
        foreach($disciplines as $discipline) {
            $attachments = DisciplineAttach::where('discipline_id', $discipline->id)->get();
            //Log::debug("Attachments");
            //Log::debug($attachments);
            $attach = array();
            foreach($attachments as $attachment) {
                array_push($attach, $attachment->discipline_attach);
            }

            $subdata = new EmployeeDisciplinary();
            $subdata = $discipline;

            // $subdata['asset_name'] = $asset->asset_name;
            // $subdata['asset_quantity'] = $asset->asset_quantity;
            // $subdata['issue_date'] = DateHelper::dateStandardFormat($asset->issue_date);
            // $subdata['asset_status'] = $asset->asset_status;
            $subdata['attach'] = $attach;
            //Log::debug("*******************");
            //Log::debug($discipline->created_by);
            $investigateBy = User::find($discipline->created_by);
            //Log::debug($investigateBy);
            $subdata['investigateBy'] = $investigateBy->name;

            $data[] = $subdata;
        }
        //Log::debug("Employee Asset");
        //Log::debug($data);

        return DataTables::of($data)        
        ->make(true);
        
    }
    
    public function getDataTableEmployeeAssets($id)
    {
        $assets = EmployeeAsset::where('emp_id','=', $id)->get();
        //Log::debug($assets);
        $data = array();
        foreach($assets as $asset) {
            $attachments = AssetAttach::where('asset_id', $asset->id)->get();
            //Log::debug("Attachments");
            //Log::debug($attachments);
            $attach = array();
            foreach($attachments as $attachment) {
                array_push($attach, $attachment->asset_attach);
            }

            $subdata = new EmployeeAsset();
            $subdata = $asset;

            // $subdata['asset_name'] = $asset->asset_name;
            // $subdata['asset_quantity'] = $asset->asset_quantity;
            // $subdata['issue_date'] = DateHelper::dateStandardFormat($asset->issue_date);
            // $subdata['asset_status'] = $asset->asset_status;
            $subdata['attach'] = $attach;

            $data[] = $subdata;
        }
        //Log::debug("Employee Asset");
        //Log::debug($data);

        return DataTables::of($data)
        ->make(true);
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
        $reportTos->load('report_to_pp');
        
        foreach($reportTos as $reportTo){
            $payrollPeriodArray = array();
            foreach($reportTo->report_to_pp as $payrollPeriod) {
                array_push($payrollPeriodArray, PayrollPeriod::find($payrollPeriod->payroll_period_id)->name);
            }
            $reportTo->payroll_period = $payrollPeriodArray;
        }
        
        return DataTables::of($reportTos)->make(true);
    }
    
    public function getDataTableSecurityGroup($id)
    {
        $security_groups = EmployeeSecurityGroup::with('security_groups')->where('emp_id', $id)->get();
        return DataTables::of($security_groups)->make(true);
    }
    
    public function getDataTableAuditTrails($id)
    {
        $user = Employee::find($id)->user;
        
        $audits = \OwenIt\Auditing\Models\Audit::where('auditable_id', $user->id);
        
        return DataTables::of($audits)->make(true);
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
            'postcode' => 'required|numeric',
            'company_id' => 'required',
            'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'gender' => 'required',
            'race' => 'required|alpha',
            'nationality' => 'required',
            'marital_status' => 'required',
            'total_children' => 'required|numeric',
            'ic_no' => 'required|unique:employees,ic_no|numeric',
            'epf_no' => 'nullable|unique:employees,epf_no|numeric',
            'epf_category' => 'required_with:epf_no',
            'tax_no' => 'nullable|unique:employees,tax_no',
            'pcb_group' => 'required_with:tax_no',
            'eis_no' => 'nullable|unique:employees,eis_no|numeric',
            'socso_no' => 'required|unique:employees,socso_no|numeric',
            'socso_category' => 'required',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'main_security_group_id'=>'required',
            'personal_email' => 'required|unique:employees|email',
            'spouse_name' =>  'nullable|min:5',
            'spouse_ic' =>'nullable|unique:employees,spouse_ic|numeric',
            'spouse_tax_no' => 'nullable|unique:employees,spouse_tax_no',
            'payment_via' => 'required',
            'payment_rate' => 'required',
            'category_id' => 'required',
        ],
            [
                'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.',
                'attach.max' => 'The file size may not be greater than 2MB.'
            ],
            [
                'code' => 'employee id',
                'dob' => 'date of birth',
                'total_children' => 'number of children',
                'company_id' => 'company',
                'main_security_group' => 'security group'
            ]);
        
        $attachment_data_url = $validated['attach'];
        $securitygroup = SecurityGroup::where('company_id','=' ,$request->company_id)
        ->where('id','=',$request->main_security_group_id)->count();
        if($request->main_security_group_id && $securitygroup ==1){
            DB::transaction(function () use ($attachment_data_url, $validated) {
                $validatedUserData['name'] = $validated['name'];
                $validatedUserData['email'] = $validated['email'];
                $validatedUserData['password'] = Hash::make($validated['password']);
                $validatedEmployeeData['code'] = $validated['code'];
                $validatedEmployeeData['contact_no'] = $validated['contact_no'];
                $validatedEmployeeData['address'] = $validated['address'];
                $validatedEmployeeData['address2'] = $validated['address2'];
                $validatedEmployeeData['address3'] = $validated['address3'];
                $validatedEmployeeData['postcode'] = $validated['postcode'];
                $validatedEmployeeData['company_id'] = $validated['company_id'];
                $validatedEmployeeData['dob'] = implode("-", array_reverse(explode("/", $validated['dob'])));
                $validatedEmployeeData['gender'] = $validated['gender'];
                $validatedEmployeeData['race'] = $validated['race'];
                $validatedEmployeeData['nationality'] = $validated['nationality'];
                $validatedEmployeeData['marital_status'] = $validated['marital_status'];
                $validatedEmployeeData['pcb_group'] = $validated['pcb_group'];
                $validatedEmployeeData['total_children'] = $validated['total_children'];
                $validatedEmployeeData['ic_no'] = $validated['ic_no'];
                $validatedEmployeeData['tax_no'] = $validated['tax_no'];
                $validatedEmployeeData['epf_no'] = $validated['epf_no'];
                $validatedEmployeeData['epf_category'] = $validated['epf_category'];
                $validatedEmployeeData['eis_no'] = $validated['eis_no'];
                $validatedEmployeeData['socso_no'] = $validated['socso_no'];
                $validatedEmployeeData['socso_category'] = $validated['socso_category'];
                $validatedEmployeeData['driver_license_no'] = $validated['driver_license_no'];
                $validatedEmployeeData['driver_license_expiry_date'] = implode("-", array_reverse(explode("/", $validated['driver_license_expiry_date'])));
                if ($validatedEmployeeData['driver_license_expiry_date'] ==='') {
                    $validatedEmployeeData['driver_license_expiry_date'] = null;
                }
                $validatedEmployeeData['main_security_group_id'] = $validated['main_security_group_id'];
                $validatedEmployeeData['personal_email'] = $validated['personal_email'];
                $validatedEmployeeData['spouse_name'] = $validated['spouse_name'];
                $validatedEmployeeData['spouse_ic'] = $validated['spouse_ic'];
                $validatedEmployeeData['spouse_tax_no'] = $validated['spouse_tax_no'];
                $validatedEmployeeData['payment_via'] = $validated['payment_via'];
                $validatedEmployeeData['payment_rate'] = $validated['payment_rate'];
                $validatedEmployeeData['category_id'] = $validated['category_id'];
                $user = User::create($validatedUserData);
                $user->assignRole('employee');
                $validatedEmployeeData['user_id'] = $user->id;
                $validatedEmployeeData['created_by'] = auth()->user()->id;
                $employee = Employee::create($validatedEmployeeData);
                if (!empty($attachment_data_url)) {
                    $attach = self::processBase64DataUrl($attachment_data_url);
                    $profileMedia = Media::create([
                        'category' => 'employee-profile',
                        'mimetype' => $attach['mime_type'],
                        'data' => $attach['data'],
                        'size' => $attach['size'],
                        'filename' => 'employee__'.date('Y-m-d_H:i:s').".".$attach['extension']
                    ]);
                    $employee->profile_media()->associate($profileMedia);
                    $employee->save();
                }
                
            });
                return redirect()->route('admin.employees')->with('status', 'Employee was successfully added!');
        }
        else {
            // return redirect()->route('admin.employees.add')->with('status', ' was successfully added!');
            Session::flash('message', "You have select wrong company security group ID");
            return Redirect::back();
        }
    }
    // SECTION: Add
    public function postEmergencyContact(Request $request, $id)
    {
        $emergencyContactData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
        ]);
        $emergencyContactData['created_by'] = auth()->user()->id;
        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);
        
        $employee = Employee::find($id);
        $employee->employee_emergency_contacts()->save($emergencyContact);
        
        return response()->json(['success'=>'Emergency Contact was successfully added']);
    }
    
    public function postDependent(Request $request, $id)
    {
        $dependentData = $request->validate([
            'name' => 'required',
            'ic_no' => 'nullable|numeric|unique:employee_dependents,ic_no,'.$id.',id',
            'occupation' => 'nullable',
            'relationship' => 'required',
            'dob' => 'required',
        ]);
        $dependentData['dob'] = implode("-", array_reverse(explode("/", $dependentData['dob'])));
        $dependentData['created_by'] = auth()->user()->id;
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
        $immigrationData['created_by'] = auth()->user()->id;
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
        $visaData['created_by'] = auth()->user()->id;
        $visa = new EmployeeVisa($visaData);
        
        $employee = Employee::find($id);
        $employee->employee_visas()->save($visa);
        
        return response()->json(['success'=>'Visa was successfully added']);
    }
    
    public function postJobAttach(Request $request, $id)
    {
        $employees = DB::table('employee_jobs')
        ->select('emp_id')
        ->where('id', $id)
        ->get();
        foreach($employees as $employee)
        {
            $emp_id= $employee->emp_id;
            $files = $request->file('job_attach');
            foreach($files as $file)
            {
                $path = $file->getClientOriginalName();
                $name = time() . '-' . $path;
                
                $attach = new AssetAttach();
                $attach->job_attach = $name;
                $attach->emp_job_id = $id;
                $attach->save();
                $file->storeAs('public/emp_id_'. $emp_id.'/job', $name);
                
            }
        }
        
        return response()->json(['success'=>'Attachment was successfully added']);
    }
    
    public function postJob(Request $request, $id)
    {
        // Add a new job
        $jobData = $request->validate([
            'basic_salary' => 'required|numeric',
            'main_position_id' => '',
            'department_id' => '',
            'team_id' => 'required',
            'cost_centre_id' => '',
            'emp_grade_id' => 'required',
            'section_id' => '',
            'job_comp_id' => 'required',
            'remarks' => '',
            'branch_id' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'job_attach' => 'nullable'
        ]);
        
        $jobData['start_date'] = implode("-", array_reverse(explode("/", $jobData['start_date'])));
        $jobData['created_by'] = auth()->user()->id;
        DB::transaction(function() use ($jobData, $id, $request) {
            Employee::where('id', $id)->update(array('basic_salary'=> ($jobData['basic_salary'])));
            
            if(isset($jobData['cost_centre_id'])) {
                Employee::where('id', $id)->update(array('cost_centre_id'=> $jobData['cost_centre_id']));
            } else {
                Employee::where('id', $id)->update(array('cost_centre_id'=> null));
            }
            
            if(isset($jobData['department_id'])) {
                Employee::where('id', $id)->update(array('department_id'=> $jobData['department_id']));
            } else {
                Employee::where('id', $id)->update(array('department_id'=> null));
            }
            
            if(isset($jobData['team_id'])) {
                Employee::where('id', $id)->update(array('team_id'=> $jobData['team_id']));
            } else {
                Employee::where('id', $id)->update(array('team_id'=> null));
            }
            
            if(isset($jobData['main_position_id'])) {
                Employee::where('id', $id)->update(array('position_id'=> $jobData['main_position_id']));
            } else {
                Employee::where('id', $id)->update(array('position_id'=> null));
            }
            
            if(isset($jobData['emp_grade_id'])) {
                Employee::where('id', $id)->update(array('grade_id'=> $jobData['emp_grade_id']));
            } else {
                Employee::where('id', $id)->update(array('grade_id'=> null));
            }
            
            if(isset($jobData['section_id'])) {
                Employee::where('id', $id)->update(array('section_id'=> $jobData['section_id']));
            } else {
                Employee::where('id', $id)->update(array('section_id'=> null));
            }
            
            if(isset($jobData['branch_id'])) {
                $branch = Branch::find($jobData['branch_id']);
                Employee::where('id', $id)->update(array('branch_id'=> $jobData['branch_id'],
                    'area_id' => $branch->area_id
                ));
            } else {
                Employee::where('id', $id)->update(array('branch_id'=> null,
                    'area_id' => null
                ));
            }
            
            if(isset($jobData['start_date'])) {
                $employeeJobs = EmployeeJob::where('emp_id', $id)->get();
                Log::debug("Isset start date");
                Log::debug($employeeJobs);
                Log::debug(count($employeeJobs));
                if(count($employeeJobs) == 0) {
                    Employee::where('id', $id)->update(array('join_group_date'=> ($jobData['start_date'])));
                    
                    if($jobData['job_comp_id'] == 1) {
                        Employee::where('id', $id)->update(array('join_company_date'=> ($jobData['start_date'])));
                    }
                } else {
                    $employeeJobsOppo = EmployeeJob::where([['emp_id', $id], ['job_comp_id', 1]])->whereNull('end_date')->get();
                    if(count($employeeJobsOppo) == 0 && $jobData['job_comp_id'] == 1) {
                        Employee::where('id', $id)->update(array('join_company_date'=> ($jobData['start_date'])));
                    }
                }
            }
            
            $currentJob = EmployeeJob::where('emp_id', $id)->whereNull('end_date')->first();
            if(!empty($currentJob)) {
                $currentJob->update(['end_date'=> date("Y-m-d", strtotime($jobData['start_date'].' -1days'))]);
                //                 LeaveService::onJobEnd($id, date("Y-m-d", strtotime($jobData['start_date'].' -1days')), $currentJob->id);
            }
            
            if(isset($jobData['status']) && in_array(2, $jobData['status']) && $jobData['job_comp_id'] == 1) {
                Employee::where('id', $id)->update(array('confirmed_date'=> $jobData['start_date']));
            }
            
            if(isset($jobData['status']) && in_array(10, $jobData['status']) && $jobData['job_comp_id'] == 1) {
                Employee::where('id', $id)->update(array('resignation_date'=> $jobData['start_date']));
            }
            
            Employee::where('id', $id)->update(array(
                'resignation_date'=> null,
                'blacklisted' => 0,
                'reason' => ""
            ));
            
            $newJob = new EmployeeJob($jobData);
            $newJob->emp_mainposition_id = $jobData['main_position_id'];
            unset($newJob->status);
            $employees = Employee::find($id);
            $newJob = $employees->employee_jobs()->save($newJob);
            
            foreach($request->status as $statusId) {
                $employeejobStatus = new EmployeeJobStatus();
                $employeejobStatus->emp_job_id = $newJob->id;
                $employeejobStatus->status_id = $statusId;
                $employeejobStatus->save();
            }
            
            if($request->hasFile('job_attach')) {
                $files = $request->file('job_attach');
                foreach($files as $file) {
                    $path = $file->getClientOriginalName();
                    $name = time() . '-' . $path;
                    
                    $attach = new JobAttach();
                    $attach->job_attach = $name;
                    $attach->emp_job_id = $newJob->id;
                    $attach->save();
                    $file->storeAs('public/emp_id_'. $id.'/job', $name);
                }
            }

//             LeaveService::onJobStart($id, $jobData['start_date'], (int)$jobData['emp_grade_id'], $newJob->id);
        });
            
        return response()->json(['success'=>'Job was successfully added']);
    }
    
    public function postResign(Request $request, $id)
    {
        $jobData = $request->validate([
            'resignation_date' => 'required',
            'reason' => 'required',
            'blacklisted' => 'required'
        ]);
        
        $currentJob = EmployeeJob::where('emp_id', $id)->whereNull('end_date')->first();
        $jobData['resignation_date'] = implode("-", array_reverse(explode("/", $jobData['resignation_date'])));
        
        if($request->get('blacklisted') == null) {
            $jobData['blacklisted'] = 0;
        } else {
            $jobData['blacklisted'] = request('blacklisted');
        }
        
//         LeaveService::onJobEnd($id, $jobData['resignation_date'], $currentJob->id, true);
        
        Employee::where('id', $id)->update(array(
            'resignation_date' => ($jobData['resignation_date']),
            'blacklisted' => ($jobData['blacklisted']),
            'reason' => ($jobData['reason'])
        ));
        $currentJob->update(array(
            'end_date'=> ($jobData['resignation_date']),
//             'status'=> 'Resigned'
        ));
                
        EmployeeJobStatus::where('emp_job_id', $id)->delete();
        $employeejobStatus = new EmployeeJobStatus();
        $employeejobStatus->emp_job_id = $currentJob->id;
        $employeejobStatus->status_id = 10;
        $employeejobStatus->save();
            
        return response()->json(['success'=>'Employee and job status has successfully been updated']);
    }
    
    public function postBankAccount(Request $request, $id)
    {
        $bankAccountData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric'
            
        ]);
        $bankAccountData['created_by'] = auth()->user()->id;
        $bankAccount = new EmployeeBankAccount($bankAccountData);
        
        $employee = Employee::find($id);
        DB::table('employee_bank_accounts')
        ->where('emp_id', $id)
        ->update([
            'acc_status'  => "Inactive"
        ]);
        $employee->employee_bank_accounts()->save($bankAccount);
        
        return response()->json(['success'=>'Bank Account was successfully added']);
    }
    
    public function postAddAsset(Request $request, $id)
    {
        $assetData = $request->validate([
            'asset_name' => 'required',
            'asset_quantity' => 'required|numeric',
            'asset_spec' => 'nullable',
            'issue_date' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'return_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'sold_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            
        ]);
        
        $assetData['issue_date'] = implode("-", array_reverse(explode("/", $assetData['issue_date'])));
        if( $assetData['return_date']!=null)
        {$assetData['return_date'] = implode("-", array_reverse(explode("/", $assetData['return_date'])));}
        if( $assetData['sold_date']!=null)
        {$assetData['sold_date'] = implode("-", array_reverse(explode("/", $assetData['return_date'])));}
        $asset= new EmployeeAsset($assetData);
        $employee = Employee::find($id);
        $employee->employee_assets()->save($asset);
        
        if($request->hasFile('asset_attach'))
        {
            $files = $request->file('asset_attach');
            foreach($files as $file)
            {
              $path = $file->getClientOriginalName();
              $name = date('d-m-Y_hia') . '-' . $path;

              $attach = new AssetAttach();
              $attach->asset_attach = $name;
              $attach->asset_id = $asset->id;
              $attach->save();
              $file->storeAs('public/emp_id_'. $id.'/asset', $name);
              
            }
        }
        
        return response()->json(['success'=>'Asset was successfully added']);
    }

    public function postAddAttach(Request $request, $id)
    {
        $employees = DB::table('employee_assets')
        ->select('emp_id')
        ->where('id', $id)
        ->get();
        foreach($employees as $employee)
        {
            $emp_id= $employee->emp_id;
            $files = $request->file('asset_attach');
            foreach($files as $file)
            {
                $path = $file->getClientOriginalName();
                $name = time() . '-' . $path;
                
                $attach = new AssetAttach();
                $attach->asset_attach = $name;
                $attach->asset_id = $id;
                $attach->save();
                $file->storeAs('public/emp_id_'. $emp_id.'/asset', $name);
                
            }
        }
        
        return response()->json(['success'=>'Attachment was successfully added']);
    }
    
public function postAsset(Request $request)
    {
        $assetData = $request->validate([
            'emp_id' => 'required',
            'asset_name' => 'required',
            'asset_quantity' => 'required|numeric',
            'asset_spec' => 'nullable',
            'issue_date' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'return_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'sold_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/' ,
            'asset_attach' => 'nullable'
        ]);
        
        
        $assetData['issue_date'] = implode("-", array_reverse(explode("/", $assetData['issue_date'])));
        if( $assetData['return_date']!=null){
            $assetData['return_date'] = implode("-", array_reverse(explode("/", $assetData['return_date'])));
        }
        if( $assetData['sold_date']!=null)
        {$assetData['sold_date'] = implode("-", array_reverse(explode("/", $assetData['return_date'])));}
        $asset= new EmployeeAsset($assetData);
        $asset->save();
        
        if($request->hasFile('asset_attach'))
        {
            $images = $request->file('asset_attach');
            foreach($images as $image)
            {
                $path = $image->getClientOriginalName();
                $name = time() . '-' . $path;
                
                $attach = new AssetAttach();
                $attach->asset_attach = $name;
                $attach->asset_id = $asset->id;
                $attach->save();
                $image->storeAs('public/emp_id_'. $assetData['emp_id'].'/asset', $name);
            }
        }
        return response()->json(['success'=>'Employee Asset was successfully added']);
    }
    
    
    
    public function postExperience(Request $request, $id)
    {
        $experienceData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'industry' => 'required',
            'contact' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'notes'=>''
        ]);
        $experienceData['start_date'] = implode("-", array_reverse(explode("/", $experienceData['start_date'])));
        $experienceData['end_date'] = implode("-", array_reverse(explode("/", $experienceData['end_date'])));
        $experienceData['created_by'] = auth()->user()->id;
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
        $educationData['created_by'] = auth()->user()->id;
        $education = new EmployeeEducation($educationData);
        
        $employee = Employee::find($id);
        $employee->employee_educations()->save($education);
        
        return response()->json(['success'=>'Education was successfully added']);
    }
    
    public function postSkill(Request $request, $id)
    {
        $skillData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required|numeric',
            'competency' => 'required'
        ]);
        $skillData['created_by'] = auth()->user()->id;
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
        
        $attachmentData['created_by'] = auth()->user()->id;
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
            'monday' => 'required|in:full,half,half_2,off,rest',
            'tuesday' => 'required|in:full,half,half_2,off,rest',
            'wednesday' => 'required|in:full,half,half_2,off,rest',
            'thursday' => 'required|in:full,half,half_2,off,rest',
            'friday' => 'required|in:full,half,half_2,off,rest',
            'saturday' => 'required|in:full,half,half_2,off,rest',
            'sunday' => 'required|in:full,half,half_2,off,rest',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
            'half_1_start_work_time' => 'required',
            'half_1_end_work_time' => 'required',
            'half_2_start_work_time' => 'required',
            'half_2_end_work_time' => 'required',
        ]);
        $workingDaysData['is_template'] = false;
        $workingDaysData['created_by'] = auth()->user()->id;
        $workingDay = new EmployeeWorkingDay($workingDayData);
        
        $employee = Employee::find($id);
        $employee->working_day()->save($workingDay);
        
        return response()->json(['success' => 'Working Day was successfully added']);
    }
    
    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayUpdateData = $request->validate([
            'monday' => 'required|in:full,half,half_2,off,rest',
            'tuesday' => 'required|in:full,half,half_2,off,rest',
            'wednesday' => 'required|in:full,half,half_2,off,rest',
            'thursday' => 'required|in:full,half,half_2,off,rest',
            'friday' => 'required|in:full,half,half_2,off,rest',
            'saturday' => 'required|in:full,half,half_2,off,rest',
            'sunday' => 'required|in:full,half,half_2,off,rest',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
            'half_1_start_work_time' => 'required',
            'half_1_end_work_time' => 'required',
            'half_2_start_work_time' => 'required',
            'half_2_end_work_time' => 'required',
        ]);
        
        $workingDayUpdateData['is_template'] = false;
        
        EmployeeWorkingDay::find($request->leave_id)->update($workingDayUpdateData);
        
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
            'report_to_emp_id' => 'required|unique:employee_report_to,report_to_emp_id,NULL,id,deleted_at,NULL,emp_id,'.$id,
            'type' => 'required',
            'report_to_level' =>'required|unique:employee_report_to,report_to_level,NULL,id,deleted_at,NULL,emp_id,'.$id,
            'kpi_proposer' => 'required',
            'notes' => 'nullable',
            'payroll_period' => 'nullable'
        ]);
        
        if($request->get('kpi_proposer') == null){
            $reportToData['kpi_proposer'] = 0;
        } else {
            $reportToData['kpi_proposer'] = request('kpi_proposer');
        }
        
        $employee_kpi_proposer = EmployeeReportTo::where('emp_id','=',$id)
        ->where('kpi_proposer', 1)->where('deleted_at','=',null)->count();
        
        $report_to_emp_id = Employee::find($id);
        
        $employee_report_to = EmployeeReportTo::where('report_to_emp_id','=',$id)
        ->where('deleted_at','=',null)->count();
        
        if ($request->kpi_proposer == 0) {
            DB::beginTransaction();
            $reportToData['created_by'] = auth()->user()->id;
            $reportTo = new EmployeeReportTo($reportToData);
            $employee = Employee::find($id);
            $employee->report_tos()->save($reportTo);
            
            if(isset($request->payroll_period)) {
                foreach($request->payroll_period as $payrollPeriodId) {
                    $reportToPP = new EmpReportToPP();
                    $reportToPP->emp_report_to_id = $reportTo->id;
                    $reportToPP->payroll_period_id = $payrollPeriodId;
                    $reportToPP->save();
                }
            }
            DB::commit();
            return response()->json(['success'=>'Report To was successfully added.']);
            
        } else if($employee_kpi_proposer == 0){
            DB::beginTransaction();
            $reportToData['created_by'] = auth()->user()->id;
            $reportTo = new EmployeeReportTo($reportToData);
            $employee = Employee::find($id);
            $employee->report_tos()->save($reportTo);
            
            if(isset($request->payroll_period)) {
                foreach($request->payroll_period as $payrollPeriodId) {
                    $reportToPP = new EmpReportToPP();
                    $reportToPP->emp_report_to_id = $reportTo->id;
                    $reportToPP->payroll_period_id = $payrollPeriodId;
                    $reportToPP->save();
                }
            }
            DB::commit();
            return response()->json(['success'=>'Report To was successfully added.']);
            
        } else {
            return response()->json(['fail'=>'KPI Proposer already exist']);
        }
        
        
        
        
    }
    
    public function postSecurityGroup(Request $request, $id)
    {
        $securityGroupData = $request->validate([
            'security_group_id' => 'required|unique:employee_security_groups,security_group_id,NULL,id,deleted_at,NULL,emp_id,'.$id
        ]);
        
        // $security = SecurityGroup::select('company_id')->where('id','=',$request->security_group_id)->get();
        // $company_id =Employee::select('company_id')->where('id','=',$security)->get();
        // if ($security == $company_id)
        // {
        $securityGroupData['created_by'] = auth()->user()->id;
        $securityGroup = new EmployeeSecurityGroup($securityGroupData);
        
        $employee = Employee::find($id);
        $employee->employee_security_groups()->save($securityGroup);
        
        return response()->json(['success'=>'Security Group was successfully updated.']);
        
        // else
        // {
        // return response()->json(['success'=>'Security Group Cannot Be Added.Please Select Security Group With Same Company ID']);
        // }
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
            'ic_no' => 'nullable|numeric|unique:employee_dependents,ic_no,'.$id.',id',
            'occupation' => 'nullable',
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
            'emp_mainposition_id' => '',
            'department_id' => '',
            'team_id' => 'required',
            'emp_grade_id' => 'required',
            'section_id' => '',
            'job_comp_id' => 'required',
            'start_date' => 'required',
            'basic_salary' => 'required',
            'remarks' => '',
            'status' => 'required'
        ]);
        $jobData['start_date'] = implode("-", array_reverse(explode("/", $jobData['start_date'])));
        
        
        if ($jobData['status']  == "confirmed-employment") {
            
            
            Employee::where('id', $emp_id)->update(array('confirmed_date'=> ($jobData['start_date'])));
            EmployeeJob::find($id)->update($jobData);
            
            return response()->json(['success'=>'Job was successfully updated.']);
        }
        else{
            EmployeeJob::find($id)->update($jobData);
            if($jobData['emp_mainposition_id'] != '') {
                $position = EmployeePosition::find($jobData['emp_mainposition_id'])->name;
            }
            Employee::where('id', $id)->update(array('position'=> @$position ? $position : ''));
            
            return response()->json(['success'=>'Job was successfully updated.']);
        }
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
    
    public function postEditDiscipline(Request $request, $emp_id, $id)
    { 
        //dd($request->all());
        $DisciplineUpdateData = $request->validate([
            'discipline_date-edit' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'discipline_desc-edit' => 'required',
            'discipline_title-edit' => 'required'
            
        ]);
        
        $DisciplineUpdateData['discipline_date-edit'] = implode("-", array_reverse(explode("/", $DisciplineUpdateData['discipline_date-edit'])));
        
        EmployeeDisciplinary::find($id)->update($DisciplineUpdateData);
        if($request->hasFile('discipline_attach'))
        {
            $files = $request->file('discipline_attach');
            foreach($files as $file)
            {
              $path = $file->getClientOriginalName();
              $name = date('d-m-Y_hia') . '-' . $path;

              $attach = new DisciplineAttach();
              $attach->discipline_attach = $name;
              $attach->discipline_id = $id;
              $attach->save();
              $file->storeAs('public/emp_id_'. $emp_id.'/discipline', $name);
              
            }
        }
        return response()->json(['success'=>'Disciplinary Issue was successfully updated.']);
    }
    
    public function postEditEmployeeAsset(Request $request, $emp_id, $id)
    {
        $assetUpdateData = $request->validate([
            'asset_name' => 'required',
            'asset_quantity' => 'required|numeric',
            'asset_spec' => 'nullable',
            'issue_date_edit' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'return_date_edit' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'sold_date_edit' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
            'asset_status' => 'required'            
        ]);
                $assetUpdateData['issue_date_edit'] = implode("-", array_reverse(explode("/", $assetUpdateData['issue_date_edit'])));
        
        if( $assetUpdateData['return_date_edit']!=null)
        {$assetUpdateData['return_date_edit'] = implode("-", array_reverse(explode("/", $assetUpdateData['return_date_edit'])));}
        
        if( $assetUpdateData['sold_date_edit']!=null)
        {$assetUpdateData['sold_date_edit'] = implode("-", array_reverse(explode("/", $assetUpdateData['sold_date_edit'])));}
        EmployeeAsset::find($id)->update($assetUpdateData);
        
        if($request->hasFile('asset_attach'))
        {
            $files = $request->file('asset_attach');
            foreach($files as $file)
            {
              $path = $file->getClientOriginalName();
              $name = date('d-m-Y_hia') . '-' . $path;

              $attach = new AssetAttach();
              $attach->asset_attach = $name;
              $attach->asset_id = $id;
              $attach->save();
              $file->storeAs('public/emp_id_'. $emp_id.'/asset', $name);
              
            }
        }
        
        return response()->json(['success'=>'Asset was successfully updated.']);
    }
    
    public function postEditExperience(Request $request, $emp_id, $id)
    {
        $experienceUpdatedData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'industry' => 'required',
            'contact' => 'required',
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
            'years_of_experience' => 'required|numeric',
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
            'payroll_period' => 'nullable'
        ]);
        
        if($request->get('kpi_proposer') == null){
            $reportToUpdatedData['kpi_proposer'] = 0;
        } else {
            $reportToUpdatedData['kpi_proposer'] = request('kpi_proposer');
        }
        
        $employee_kpi_proposer = EmployeeReportTo::where('emp_id','=',$emp_id)
        ->where('kpi_proposer', 1)->where('deleted_at','=',null)->count();
        
        $kpi_proposer = EmployeeReportTo::where('id','=',$id)->where('kpi_proposer',1)->count();
        
        if($request->kpi_proposer == 0){
            DB::beginTransaction();
            EmpReportToPP::where('emp_report_to_id', $id)->delete();
            $reportTo = EmployeeReportTo::find($id);
            $reportTo->save();
            if(isset($request->payroll_period)){
                foreach($request->payroll_period as $payrollPeriodId) {
                    $reportToPP = new EmpReportToPP();
                    $reportToPP->emp_report_to_id = $reportTo->id;
                    $reportToPP->payroll_period_id = $payrollPeriodId;
                    $reportToPP->save();
                }
            }
            EmployeeReportTo::find($id)->update($reportToUpdatedData);
            DB::commit();
            return response()->json(['success'=>'Report To was successfully updated.']);
        } else
            if($employee_kpi_proposer == 0){
                DB::beginTransaction();
                EmpReportToPP::where('emp_report_to_id', $id)->delete();
                $reportTo = EmployeeReportTo::find($id);
                $reportTo->save();
                if(isset($request->payroll_period)){
                    foreach($request->payroll_period as $payrollPeriodId) {
                        $reportToPP = new EmpReportToPP();
                        $reportToPP->emp_report_to_id = $reportTo->id;
                        $reportToPP->payroll_period_id = $payrollPeriodId;
                        $reportToPP->save();
                    }
                }
                EmployeeReportTo::find($id)->update($reportToUpdatedData);
                DB::commit();
                return response()->json(['success'=>'Report To was successfully updated.']);
        } else
            if($kpi_proposer == 1){
                DB::beginTransaction();
                EmpReportToPP::where('emp_report_to_id', $id)->delete();
                $reportTo = EmployeeReportTo::find($id);
                $reportTo->save();
                if(isset($request->payroll_period)){
                    foreach($request->payroll_period as $payrollPeriodId) {
                        $reportToPP = new EmpReportToPP();
                        $reportToPP->emp_report_to_id = $reportTo->id;
                        $reportToPP->payroll_period_id = $payrollPeriodId;
                        $reportToPP->save();
                    }
                }
                EmployeeReportTo::find($id)->update($reportToUpdatedData);
                DB::commit();
                return response()->json(['success'=>'Report To was successfully updated.']);
        } else
        {
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
    
    public function deleteJob(Request $request, $emp_id, $id)
    {
        DB::beginTransaction();
        $leave_request_approvals = LeaveRequestApproval::where('leave_request_id',$id)->get();
        foreach ($leave_request_approvals as $leave_request_approval) {
            LeaveRequestApproval::find($leave_request_approval->id)->delete();
        }
        $leave_requests = LeaveRequest::where('leave_allocation_id',$id)->get();
        foreach ($leave_requests as $leave_request) {
            LeaveRequest::find($leave_request->id)->delete();
        }
        $leave_allocations = LeaveAllocation::where('emp_job_id',$id)->get();
        foreach ($leave_allocations as $leave_allocation) {
            LeaveAllocation::find($leave_allocation->id)->delete();
        }
//         $empJobs = EmployeeJob::where('id', $id);
        $emp = $emp_id;
        $jobs = JobAttach::where('emp_job_id',$id)->get();
        foreach ($jobs as $job) {
            $job_attach=$job->job_attach;
            Storage::delete('public/emp_id_'.$emp.'/job/'.$job_attach);
        }
        EmployeeJob::find($id)->delete();
        EmployeeJobStatus::where('emp_job_id', $id)->delete();
        JobAttach::where('emp_job_id',$id)->delete();
        
        // Update Employees Table
        
        
        DB::commit();
        return response()->json(['success'=>'Job was successfully deleted.']);
    }
    
    public function deleteBankAccount(Request $request, $emp_id, $id)
    {
        EmployeeBankAccount::find($id)->delete();
        return response()->json(['success'=>'Bank Account was successfully deleted.']);
    }
    public function deleteEmployeeAsset(Request $request, $emp_id, $id)
    {
        
        $employees = DB::table('asset_attachs')
        ->select('asset_attach')
        ->where('asset_id', $id)
        ->get();
        foreach ($employees as $employee) {
            $emp=$employee->asset_attach;;
            Storage::delete('public/emp_id_'.$emp_id.'/asset/'.$emp);
        }
        DB::table('asset_attachs')
        ->where('asset_id', $id)
        ->delete();
        EmployeeAsset::find($id)->delete();
        
        return response()->json(['success'=>'Asset was successfully deleted.']);
    }
    
    public function deleteDisciplinary(Request $request, $emp_id, $id)
    {
        
        $employees = DB::table('discipline_attachs')
        ->select('discipline_attach')
        ->where('discipline_id', $id)
        ->get();
        foreach ($employees as $employee) {
            $emp=$employee->discipline_attach;;
            Storage::delete('public/emp_id_'.$emp_id.'/discipline/'.$emp);
        }
        DB::table('discipline_attachs')
        ->where('discipline_id', $id)
        ->delete();
        EmployeeDisciplinary::find($id)->delete();
        
        return response()->json(['success'=>'Disciplinary Issue was successfully deleted.']);
    }
    public function deleteAssetAttach(Request $request,$id)
    {
        $employees = DB::table('employee_assets')
        ->join('asset_attachs', 'employee_assets.id', '=', 'asset_attachs.asset_id')
        ->select('employee_assets.emp_id as emp','asset_attachs.asset_attach as asset_attach')
        ->where('asset_attachs.id', $id)
        ->get();
        foreach ($employees as $employee) {
            $emp=$employee->emp;
            $asset_attach=$employee->asset_attach;
            Storage::delete('public/emp_id_'.$emp.'/asset/'.$asset_attach);
        }
        
        AssetAttach::find($id)->delete();
        return redirect()->back() ->with('status', 'Attachment Successfully Deleted!');
    }

     public function deleteDisciplineAttach(Request $request,$id)
    {
        $employees = DB::table('employee_disciplines')
        ->join('discipline_attachs', 'employee_disciplines.id', '=', 'discipline_attachs.discipline_id')
        ->select('employee_disciplines.emp_id as emp','discipline_attachs.discipline_attach as discipline_attach')
        ->where('discipline_attachs.id', $id)
        ->get();
        foreach ($employees as $employee) {
            $emp=$employee->emp;
            $discipline_attach=$employee->discipline_attach;
            Storage::delete('public/emp_id_'.$emp.'/discipline/'.$discipline_attach);
        }
        
        DisciplineAttach::find($id)->delete();
        return redirect()->back() ->with('status', 'Attachment Successfully Deleted!');

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
        EmpReportToPP::where('emp_report_to_id', $id)->delete();
        return response()->json(['success'=>'Report To was successfully deleted.']);
    }
    
    public function deleteSecurityGroup(Request $request, $emp_id, $id)
    {
        EmployeeSecurityGroup::find($id)->delete();
        return response()->json(['success'=>'Security Group was successfully deleted.']);
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
    // public function postDisapproved(Request $request)
    // {
    //     $id = $request->input('id');
    //     $emp_id = $request->input('emp_id');
    //     $leave_type_id = $request->input('leave_type_id');
    //     $total_days =$request->input('total_days');
    
    //     $leaveAllocationData1 = LeaveAllocation::select ('spent_days')->where('emp_id',$emp_id)
    //     ->where('leave_type_id',$leave_type_id)->first()->spent_days;
    
    //     $leaveAllocationData = number_format($leaveAllocationData1,1);
    //     $total_days =number_format($total_days,1);
    //     $leaveAllocationDataEntry = $leaveAllocationData - $total_days;
    
    //     LeaveRequest::where('id',$id)->update(array('status' => 'rejected'));
    //     $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
    
    //     $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
    //     ->where('leave_type_id',$leave_type_id)
    //     ->update(array('spent_days'=>$leaveAllocationDataEntry));
    
    //     return redirect()->route('leaverequest');
    // }
    
    public function postEditRoles(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
        ]);
        
        $employee = Employee::where('id', $id)->first();
        $employee->user->syncRoles([$request['role']]);
        
        return response()->json(['success'=>'Employee\'s role is updated.']);
    }
    
    public function importUser($fileName, $companyId)
    {
        $collection = (new UserImport)->toCollection($fileName);
        //         dd($collection);
        
        $passwordString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        
        foreach ($collection[0] as $row)
        {
            $password = substr(str_shuffle($passwordString), 0, 12);
            
            $user = User::create([
                'name' => $row['name'],
                'password' => bcrypt($password),
                'email' => $row['email'],
            ]);
            
            $user->assignRole('employee');
            
            if($row['role'] != null){
                $user->assignRole($row['role']);
            }
            
            $nationality = Country::where('citizenship',$row['nationality'])->first();
            $pcbGroup = 1;
            
            if($row['marital_status'] == 'MARRIED'){
                $pcbGroup = 2;
            }
            
            $dob = substr($row['date_of_birth'],6,4).'-'.substr($row['date_of_birth'],3,2).'-'.substr($row['date_of_birth'],0,2);
            
            Employee::create([
                'user_id' => $user->id,
                'code' => $row['employee_id'],
                'contact_no' => $row['contact_no'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'company_id' => $companyId,
                'dob' => $dob,
                'gender' => $row['gender'],
                'race' => $row['race'],
                'nationality' => $nationality->id,
                'marital_status' => $row['marital_status'],
                'total_children' => 0,
                'ic_no' => $row['ic'],
                'tax_no' => $row['tax_no'],
                'epf_no' => $row['epf_no'],
                'socso_no' => $row['socso_no'],
                'eis_no' => $row['eis_no'],
                'pcb_group' => $pcbGroup,
                'main_security_group_id' => 1,
                'personal_email' => $row['personal_email'],
                'spouse_name' => $row['spouse_name'],
                'spouse_ic' => $row['spouse_ic'],
                'spouse_tax_no' => $row['spouse_tax_no'],
                'payment_via' => $paymentviaGroup,
                'payment_rate' => $paymentrateGroup,
            ]);
            $emailData = array();
            $emailData['name'] = $row['name'];
            $emailData['email'] = $row['email'];
            $emailData['password'] = $password;
            
            //send email
            Mail::to($row['email'])
            ->bcc(env('BCC_EMAIL'))
            ->send(new NewUserMail($emailData));
        }
        return "Total ".count($collection[0])." records";
    }
    
    public function exportEmployees(Request $request)
    { 
        Log::debug("Export Employee");
        Log::debug($request);
        
        $header = array();
        $rows = [];
        
        if (isset($request->visibleColumns)) {
            $tableHeaderEnum = EmployeeTableHeaderEnum::consts();

            foreach($request->visibleColumns as $index) {
                if($index > 0 && $index < 23) {
                    $enumIndex = $index-1;
                    $headerTitle = str_replace("_", " ", $tableHeaderEnum[$enumIndex]);
                    array_push($header, $headerTitle);
                }
            }
            Log::debug($header);
        }
        //header and data
        
        $result = FilterHelper::getEmployees($request);
        $employees = $result[2];
        Log::debug($employees);
        
        foreach($employees as $employee) {
            $row = array();
            foreach($request->visibleColumns as $index) {
                if($index > 0 && $index < 23) {
                    array_push($row, $employee[$index]);
                }
            }
            $rows[] = $row;
        }
        Log::debug($rows);
        
        if($request->fileType == 'pdf') {
            $pdf = PDF::loadView('pages/admin/employees/export-employees', ['header' => $header, 'rows' => $rows])->setOrientation('landscape');
            $pdf->setTemporaryFolder(storage_path("temp"));
            return $pdf->download('employees.pdf');
        } else if($request->fileType == 'xlsx') {
            //first row style
            $headerStyleArray = [
                'font' => [
                    'bold' => true,
                    'name' => 'Arial',
                    'size' => '10'
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    
                ],
            ];
            
            $fontArray = [
                'font' => [
                    'name' => 'Arial',
                    'size' => '10'
                ],
            ];
            
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getStyle('A:U')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle('A:U')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
//             $sheet->getStyle('A:U')->getAlignment()->setWrapText(true);
            $sheet->getStyle('A1:U1')->applyFromArray($headerStyleArray);
            $sheet->getStyle('A:U')->applyFromArray($fontArray);
            
            $i=0;
            Log::debug("Count Header". count($header));
            Log::debug($header);
            foreach (range('A', 'U') as $char) {
                Log::debug($i);
                $sheet->getCell($char.'1')->setValue($header[$i]);
                if($i >= count($header)-1) {
                    break;
                }
                $i++;
            }
            
            $rowNumber = 2;
            foreach($rows as $row) {
                $i = 0;
                foreach (range('A', 'U') as $char) {
                    Log::debug($i);
                    if($i <= count($row)-1) {
                        $sheet->getCell($char.$rowNumber)->setValue($row[$i]);
                    }
                    $i++;
                }
                $rowNumber++;
            }
            
            $writer = new Xlsx($spreadsheet);
            $filename = 'Employees';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
            header('Cache-Control: max-age=0');
            
            $writer->save('php://output'); // download file
            return;
        }
    }
}
