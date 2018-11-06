<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyContact;
use App\EmployeeDependent;
use App\EmployeeImmigrationOrVisa;
use App\EmployeeSkills;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeBank;
use App\EmployeeJob;
use App\EmployeeReportTo;
use App\EventLog;
use App\User;
use App\EmployeeAttachment;
use App\EmployeeInfo;
use DB;
use Auth;
use Log;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function displayProfile()
    {
        $user = EmployeeInfo::join('users','users.emp_id','=','employee_info.emp_id')
        ->join('countries','countries.id','=','employee_info.citizenship')
        ->join('employee_job','employee_job.emp_id','=','employee_info.emp_id')
        //->join('employee_grade','employee_job.id_grade','=','employee_grade.id')
        ->select('employee_info.name','users.email', 'employee_info.contact_no', 'employee_info.address', 
        'employee_info.ic_no', 'employee_info.gender', 'employee_info.dob',
        'employee_info.marital_status', 'employee_info.race', 'employee_info.total_child', 
        'employee_info.driver_license_number', 'employee_info.license_expiry_date','users.emp_id',
        'employee_info.epf_no','employee_info.tax_no','employee_info.basic_salary','countries.citizenship')
        ->where('users.id', auth()->user()->id)
        ->first();
        return view('pages.employee.profile')->with('user',$user);
    }

    public function displayEmergencyContact()
    {
        $contacts = EmergencyContact::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.emergency-contact', ['contacts'=>$contacts]);
        return DataTables::of($contacts)->make(true);
    }

    public function displayEmployeeDependent()
    {       
        $dependents = EmployeeDependent::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.employee-dependent', ['dependents'=>$dependents]);
        return DataTables::of($dependents)->make(true);
    }

    public function displayImmigration()
    {
        $immigrations = EmployeeImmigration::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.employee-immigration', ['immigrations'=>$immigrations]);
        return DataTables::of($immigrations)->make(true);
    }

    public function displayVisa()
    {       
        $visa = EmployeeVisa::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.employee-visa', ['visa'=>$visa]);
        return DataTables::of($visa)->make(true);

    }

    public function displayQualificationCompanies()
    {
        $companies = EmployeeExperience::where('emp_id', auth()->user()->id)->get();
        
        // return view('pages.employee.qualification', ['companies'=>$companies, 'educations'=>$educations,'skills'=>$skills]);
        return DataTables::of($companies)->make(true);
    }
    public function displayQualificationEducations() {
        $educations = EmployeeEducation::where('emp_id', auth()->user()->id)->get();
        return DataTables::of($educations)->make(true);
    }
    public function displayQualificationSkills() {
        $skills = EmployeeSkills::where('emp_id', auth()->user()->id)->get();
        return DataTables::of($skills)->make(true);
    }

    public function displayBank()
    {       
        $banks = EmployeeBank::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.bank', ['banks'=>$banks]);
        return DataTables::of($banks)->make(true);
    }

    public function displayJob()
    {       
        $data = EmployeeJob::join('department','employee_job.id_department','=','department.id')
        ->join('employee_main_position','employee_job.id_main_position','=','employee_main_position.id')
        ->join('employee_team','employee_job.id_team','=','employee_team.id')
        ->join('employee_grade','employee_job.id_grade','=','employee_grade.id')
        ->join('employee_category','employee_job.id_category','=','employee_category.id')
        ->select('employee_job.created_on','employee_main_position.name AS positionname','department.name AS departname','employee_team.team_name AS teamname','employee_category.category_name AS categoryname','employee_grade.name AS gradename','employee_job.basic_salary','employee_job.status')
        ->where('emp_id', auth()->user()->id)
        ->get();
       
        $jobs = json_decode($data, true);

        // return view('pages.employee.job', ['jobs'=>$jobs]);
        return DataTables::of($jobs)->make(true);
    }

    public function displayReportTo()
    {
        $data = EmployeeReportTo::join('employee_info','employee_info.emp_id','=','employee_report_to.report_id_emp_master')
        ->select('employee_info.name','employee_report_to.type','employee_report_to.note','employee_report_to.kpi_proposer')
        ->where('employee_report_to.emp_id', auth()->user()->id)
        ->get();

        $reports = json_decode($data, true);

        // return view('pages.employee.report-to', ['reports'=>$reports]);
        return DataTables::of($reports)->make(true);
    }

    public function displayHistory()
    {       
        $history = EventLog::join('employee_info','employee_info.emp_id','=','event_log.created_by')
        ->select('employee_info.name','event_log.type','event_log.note','event_log.created_on')
        ->where('event_log.emp_id', auth()->user()->id)
        ->get();
        // return view('pages.employee.history', ['history'=>$history]);
        return DataTables::of($history)->make(true);
    }

    public function displayAttachment()
    {       
        $attachments = EmployeeAttachment::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.attachment', ['attachments'=>$attachments]);
        return DataTables::of($attachments)->make(true);
    }

    //------ for features purposes ------------
    public function find($emp_id)
    {
        $query = EmergencyCOntact::query();

        if($id){
            $result = $query->where('id',$id)->first();
        }else{
            $result = $query->where('emp_id', $emp_id)->get();
        }

        return $result;
    }
}
