<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use App\Employee;
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

class EmployeeController extends Controller
{
    //

    public function displayProfile()
    {
        $employee = Employee::with('user', 'employee_jobs')->find(Auth::user()->employee->id);

        // $bank_list = Bank::all();
        // $cost_centre = CostCentre::all();
        // $department = Department::all();
        // $team = Team::all();
        // $position = EmployeePosition::all();
        // $grade = EmployeeGrade::all();
        // $branch = Branch::all();
        // $countries = Country::all();
        // $companies = Company::all();

        return view('pages.employee.id', ['employee' => $employee]);        
    }

    // SECTION: Data Tables

    public function getDataTableDependents()
    {       
        $dependents = EmployeeDependent::where('emp_id', Auth::user()->employee->id)->get();

        return DataTables::of($dependents)->make(true);
    }

    public function getDataTableImmigrations()
    {       
        $immigrations = EmployeeImmigration::where('emp_id', Auth::user()->employee->id)->get();
        
        return DataTables::of($immigrations)->make(true);
    }

    public function getDataTableVisas()
    {       
        $visa = EmployeeVisa::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($visa)->make(true);
    }

    public function getDataTableBankAccounts()
    {       
        $banks = EmployeeBankAccount::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($banks)->make(true);
    }

    public function getDataTableJobs()
    {       
        $job = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($job)->make(true);
    }

    public function getDataTableExperiences()
    {   
        $experiences = EmployeeExperience::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($experiences)->make(true);
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
        $attachments = EmployeeAttachment::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableEmergencyContacts()
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($contacts)->make(true);
    }

    public function getDataTableReportTo()
    {
        $reportTos = EmployeeReportTo::with('report_to.user')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($reportTos)->make(true);
    }
}
