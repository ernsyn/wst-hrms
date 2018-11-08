<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyContact;
use App\EmployeeDependent;
use App\EmployeeImmigration;
use App\EmployeeVisa;
use App\EmployeeSkills;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeBankAccount;
use App\EmployeeJob;
use App\EmployeeReportTo;
use App\EventLog;
use App\User;
use App\EmployeeAttachment;
use App\EmployeeInfo;
use App\LeaveType;
use App\Employee;
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
        $user = Employee::join('users','users.id','=','employees.user_id')
  
        ->join('employee_jobs','employee_jobs.emp_id','=','employees.id')
        //->join('employee_grade','employee_jobs.id_grade','=','employee_grade.id')
        ->select('users.name','users.email', 'employees.contact_no', 'employees.address', 
        'employees.ic_no', 'employees.gender', 'employees.dob',
        'employees.marital_status', 'employees.race', 'employees.total_children as total_child', 
        'employees.driver_license_no as driver_license_number', 'employees.driver_license_expiry_date as license_expiry_date','users.id',
        'employees.epf_no','employees.tax_no','employees.basic_salary')
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
        $banks = EmployeeBankAccount::where('emp_id', auth()->user()->id)->get();
        // return view('pages.employee.bank', ['banks'=>$banks]);
        return DataTables::of($banks)->make(true);
    }

    public function displayJob()
    {       
        $data = EmployeeJob::join('departments','employee_jobs.department_id','=','departments.id')
        ->join('employee_positions','employee_jobs.emp_mainposition_id','=','employee_positions.id')
        ->join('teams','employee_jobs.team_id','=','teams.id')
        ->join('employee_grades','employee_jobs.emp_grade_id','=','employee_grades.id')
        ->join('cost_centres','employee_jobs.cost_centre_id','=','cost_centres.id')
        ->select('employee_jobs.created_by','employee_positions.name AS positionname','departments.name AS departname','teams.name AS teamname','cost_centres.name AS categoryname','employee_grades.name AS gradename','employee_jobs.basic_salary','employee_jobs.status')
        ->where('emp_id', auth()->user()->id)
        ->get();
       
        $jobs = json_decode($data, true);

        // return view('pages.employee.job', ['jobs'=>$jobs]);
        return DataTables::of($jobs)->make(true);
    }

    public function displayReportTo()
    {
        $data = EmployeeReportTo::join('employees','employees.emp_id','=','employee_report_to.report_id_emp_master')
        ->select('employees.name','employee_report_to.type','employee_report_to.note','employee_report_to.kpi_proposer')
        ->where('employee_report_to.emp_id', auth()->user()->id)
        ->get();

        $reports = json_decode($data, true);

        // return view('pages.employee.report-to', ['reports'=>$reports]);
        return DataTables::of($reports)->make(true);
    }

    public function displayHistory()
    {       
        $history = EventLog::join('employees','employees.emp_id','=','event_log.created_by')
        ->select('employees.name','event_log.type','event_log.note','event_log.created_on')
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

    public function displayLeaveApplication()
    {        
        $types = LeaveType::all();
        return view('pages.leaveapplication', ['types'=>$types]);
    }
}
