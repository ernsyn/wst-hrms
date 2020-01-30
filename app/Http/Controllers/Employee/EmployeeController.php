<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Enums\EpfCategoryEnum;
use App\Enums\PCBGroupEnum;
use App\Enums\AssetStatusEnum;
use App\Enums\PaymentViaEnum;
use App\Enums\PaymentEnum;
use App\Enums\PaymentRateEnum;
use App\Enums\SocsoCategoryEnum;
use App\Http\Controllers\Controller;
use Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use App\User;
use App\Employee;
use App\EmployeeAsset;
use App\EmployeeDependent;
use App\EmployeeImmigration;
use App\EmployeeVisa;
use App\EmployeeBankAccount;
use App\EmployeeJob;
use App\EmployeeExperience;
use App\EmployeeEducation;
use App\EmployeeSkill;
use App\EmployeeAttachment;
use App\EmployeeEmergencyContact;
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\EmployeeWorkingDay;
use App\EmployeeAttendance;
use App\Media;
use App\AssetAttach;
use App\Category;
use App\Helpers\FilterHelper;
use App\Helpers\AccessControllHelper;
use App\CompanyAsset;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return view('pages.employee.index', ['costCentres'=> $costCentres, 'departments' => $departments,
            'sections' => $sections, 'positions' => $positions, 'teams' => $teams, 'categories' => $categories,
            'areas' => $areas, 'grades' => $grades, 'bankCodes' => $bankCodes
        ]);
    }

    public function getDataTableEmployees(Request $request)
    {
        $result = FilterHelper::getEmp($request);
        return Datatables::of($result[0])->with([
            'recordsTotal' => $result[1],
            'recordsFiltered' => $result[1],
            'data' => $result[2]
        ])->make(true);
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
        
        return view('pages.employee.employeelist', ['employee' => $employee, 'userMedia' => $userMedia, 'securityGroup' => $securityGroup, 'roles' => $roles, 'epfCategory' => $epfCategory, 'pcbGroup' => $pcbGroup, 'socsoCategory' => $socsoCategory, 'paymentviaGroup' => $paymentviaGroup,'paymentrateGroup' => $paymentrateGroup,'items' => $items,'categories' => $categories,'jobs'=> $jobs,'details' => $details]);
    }
    

    public function displayProfile()
    {
        $id = Auth::user()->employee->id;
        $employee = Employee::with('user')
        /*->with(['employee_confirmed' => function($query) use ($id)
        {
            $query->where('status','=','confirmed-employment')
            ->where ('emp_id','=',$id);
        }])*/
        ->find($id);

        $userMedia = DB::table('employees')
        ->join('medias', 'employees.profile_media_id', '=', 'medias.id')
        ->select('medias.*')
        ->where('employees.id', $id)
        ->first();
        
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

        $epfCategory = EpfCategoryEnum::choices();
        $pcbGroup = PCBGroupEnum::choices();
        $socsoCategory = SocsoCategoryEnum::choices();
        $categories = Category::all();
        return view('pages.employee.id', ['employee' => $employee,'userMedia' => $userMedia, 'epfCategory' => $epfCategory, 'pcbGroup' => $pcbGroup, 'socsoCategory' => $socsoCategory,'categories' => $categories,'details'=>$details]);   	
    }
    public function displayAsset()
    {
        $id = Auth::user()->employee->id;
        $employee = Employee::with('user')
        /*->with(['employee_confirmed' => function($query) use ($id)
        {
            $query->where('status','=','confirmed-employment')
            ->where ('emp_id','=',$id);
        }])*/
        ->find($id);
        $employeeAssets = EmployeeAsset::where('emp_id','=', $id)->get();
        return view('pages.employee.asset', ['employee' => $employee,'employeeAssets' => $employeeAssets]);
    }
    public function displayAttach(Request $request, $id)
    {
        $id = $id; 
        $attachs = DB::table('asset_attachs')
        ->select('asset_attach','id')
        ->where('asset_id', $id)
        ->get();
       
        return view('pages.employee.assetattach',['attachs' => $attachs,'id' => $id]);   
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
        return view('pages.employee.assetid', ['employee' => $employee, 'userMedia' => $userMedia, 'roles' => $roles, 'items' => $items,'details' => $details]);          
    }
    public function postEditProfilePicture(Request $request) 
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

        $emp_id = Auth::user()->employee->id;

        $picture_data_url = $pictureData['attachment'];
        $attach = self::processBase64DataUrl($picture_data_url);
        $updatepictureData['category']= 'employee-picture';
        $updatepictureData['mimetype']= $attach['mime_type'];
        $updatepictureData['data']= $attach['data'];
        $updatepictureData['size']= $attach['size'];
        $updatepictureData['filename']= 'employee_'.($emp_id).'_'.date('Y-m-d_H:i:s').".".$attach['extension'];
        

        DB::transaction(function() use ($emp_id, $updatepictureData) {
            $employee = Employee::find($emp_id);

            $oldProfileMedia = $employee->profile_media;
    
            if(!empty($oldProfileMedia)) {
                $employee->profile_media()->dissociate();
                $employee->save();
        
                $oldProfileMedia->delete();
            }
            
            $employee->profile_media()->associate(Media::create($updatepictureData));
            $employee->save();    
        });

        return response()->json(['success'=>'Profile Picture was successfully updated.']);
    }

    public function postEditProfile(Request $request)
    {
        $id = Auth::user()->employee->id;
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
            'main_security_group_id'=>'',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
            'nationality' => 'required',
            'personal_email' => 'required|email|unique:employees,personal_email,'.$id.',id',
            'payment_via' => 'required',
            'payment_rate' =>'required',
            'spouse_name' => 'nullable',
            'spouse_ic' => 'nullable',
            'spouse_tax_no' => 'nullable',
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

        Employee::find($id)->update($profileUpdatedData);

        return response()->json(['success'=>'Profile was successfully updated.']);
    }


    public function postChangePassword(Request $request) {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_new_password|same:confirm_new_password',
        ]);

        if (!(Hash::check($data['current_password'],  Auth::user()->password))) {
            response()->json(['errors'=> [
                'current_password' => ['The current password is incorrect.']
            ]], 422);
            return response()->json(['fail'=>'The current password is incorrect. Password was not successfully updated.']);
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => bcrypt($data['new_password'])
            ]);
            return response()->json(['success'=>'Password was successfully updated.']);
        }
    }

    // SECTION: Data Tables
    public function getDataTableEmergencyContacts()
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($contacts)->make(true);
    }

    public function getDataTableDependents()
    {
        $dependents = EmployeeDependent::where('emp_id', Auth::user()->employee->id)->get();

        return DataTables::of($dependents)
        ->editColumn('dob', function ($dependent) {
            return date('d/m/Y', strtotime($dependent->dob) );
        })
        ->make(true);
    }

    public function getDataTableImmigrations()
    {
        $immigrations = EmployeeImmigration::where('emp_id', Auth::user()->employee->id)->get();

        return DataTables::of($immigrations)
        ->editColumn('issued_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->issued_date) );
        })
        ->editColumn('expiry_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableVisas()
    {
        $visas = EmployeeVisa::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($visas)
        ->editColumn('issued_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->issued_date) );
        })
        ->editColumn('expiry_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableJobs()
    {
        $jobs = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($jobs)
        ->editColumn('start_date', function ($job) {
            if ($job->start_date !== null)
            return date('d/m/Y', strtotime($job->start_date) );
        })
        ->make(true);
    }

    public function getDataTableBankAccounts()
    {
        $banks = EmployeeBankAccount::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($banks)->make(true);
    }

    public function getDataTableExperiences()
    {
        $experiences = EmployeeExperience::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($experiences)
        ->editColumn('start_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->start_date) );
        })
        ->editColumn('end_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->end_date) );
        })
        ->make(true);
    }

    public function getDataTableEducation()
    {
        $educations = EmployeeEducation::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($educations)->make(true);
    }

    public function getDataTableSkills()
    {
        $skills = EmployeeSkill::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($skills)->make(true);
    }

    public function getDataTableAttachments()
    {
        $attachments = EmployeeAttachment::with('medias')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableReportTo()
    {
        $reportTos = EmployeeReportTo::with('employee_report_to.user')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($reportTos)->make(true);
    }

    public function getDataTableSecurityGroup()
    {
        $security_groups = EmployeeSecurityGroup::with('security_groups')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($security_groups)->make(true);
    }

    public function getDataTableAuditTrails()
    {
        $audits = \OwenIt\Auditing\Models\Audit::where('auditable_id', Auth::user()->id);

        return DataTables::of($audits)->make(true);
    }

    // SECTION: Ajax
    public function ajaxGetAttendances() {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $attendances = EmployeeAttendance::where('emp_id', Auth::user()->employee->id)
        ->whereDate('date', '>=', $startOfMonth)
        ->whereDate('date', '<=', $endOfMonth)->get();

        return $attendances;
    }

    // SECTION: Add
    public function postEmergencyContact(Request $request)
    {
        $emergencyContactData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
        ]);
        $emergencyContactData['created_by'] = auth()->user()->id;
        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);

        $employee = Employee::find(auth()->user()->employee->id);
        $employee->employee_emergency_contacts()->save($emergencyContact);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postDependent(Request $request)
    {
        $dependentData = $request->validate([
            'name' => 'required',            
            'ic_no' => 'nullable',
            'occupation' => 'nullable',
            'relationship' => 'required',
            'dob' => 'required'
        ]);
        $dependentData['dob'] = implode("-", array_reverse(explode("/", $dependentData['dob'])));
        $dependentData['created_by'] = auth()->user()->id;
        $dependent = new EmployeeDependent($dependentData);

        $employee = Employee::find(auth()->user()->employee->id);
        $employee->employee_dependents()->save($dependent);

        return response()->json(['success'=>'Dependent is successfully added']);
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

    private static function processBase64DataUrl($dataUrl) {
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

    // SECTION: Edit
    public function postEditEmergencyContact(Request $request, $id)
    {
        $emergencyContactUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
        ]);

        EmployeeEmergencyContact::find($id)->update($emergencyContactUpdatedData);

        return response()->json(['success'=>'Emergency Contact was successfully updated.']);
    }

    public function postEditDependent(Request $request, $id)
    {
        $dependentUpdatedData = $request->validate([
            'name' => 'required',
            'ic_no' => 'nullable',
            'occupation' => 'nullable',
            'relationship' => 'required',
            'dob' => 'required'
        ]);
        $dependentUpdatedData['dob'] = implode("-", array_reverse(explode("/", $dependentUpdatedData['dob'])));
        EmployeeDependent::find($id)->update($dependentUpdatedData);

        return response()->json(['success'=>'Dependent was successfully updated.']);
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
    public function deleteEmergencyContact(Request $request, $id)
    {
        EmployeeEmergencyContact::find($id)->delete();
        return response()->json(['success'=>'Emergency Contact was successfully deleted.']);
    }

    public function deleteDependent(Request $request, $id)
    {
        EmployeeDependent::find($id)->delete();
        return response()->json(['success'=>'Dependent was successfully deleted.']);
    }
    
    public function deleteAttachment(Request $request, $emp_id, $id)
    {
        EmployeeAttachment::find($id)->delete();
        return response()->json(['success'=>'Attachment was successfully deleted.']);
    }
}
