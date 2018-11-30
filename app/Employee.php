<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'address',
        'company_id',
        'contact_no',
        'dob',
        'gender',
        'race',
        'nationality',
        'marital_status',
        'total_children',
        'ic_no',
        'tax_no',
        'epf_no',
        'eis_no',
        'socso_no',
        'driver_license_no',
        'driver_license_expiry_date',
        'created_by',
        'main_security_group_id'
    ];

    protected $dates = [
        'dob',
        'driver_license_expiry_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function security_groups()
    {
        return $this->belongsTo('App\SecurityGroup', 'main_security_group_id');
    }
    public function report_to_emp_id()
    {
        return $this->belongsTo('App\EmployeeReportTo', 'user_id','emp_id');
    }

    public function report_to()
    {
        return $this->belongsTo('App\EmployeeReportTo', 'user_id','report_to_emp_id');
    }


    public function employee_jobs()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id');
    }

    public function employee_emergency_contacts()
    {
        return $this->hasMany('App\EmployeeEmergencyContact', 'emp_id');
    }

    public function employee_bank_accounts()
    {
        return $this->hasMany('App\EmployeeBankAccount', 'emp_id');
    }

    public function employee_dependents()
    {
        return $this->hasMany('App\EmployeeDependent', 'emp_id');
    }

      public function leave_requests()
    {
        return $this->hasMany('App\LeaveRequest', 'emp_id');
    }

    public function employee_security_groups()

    {

        return $this->hasMany('App\EmployeeSecurityGroup', 'emp_id');

    }
    public function employee_experiences()
    {
        return $this->hasMany('App\EmployeeExperience', 'emp_id');
    }
    public function employee_educations()
    {
        return $this->hasMany('App\EmployeeEducation', 'emp_id');
    }
    public function employee_skills()
    {
        return $this->hasMany('App\EmployeeSkill', 'emp_id');
    }

    public function employee_visas()
    {
        return $this->hasMany('App\EmployeeVisa', 'emp_id');
    }

    public function employee_immigrations()
    {
        return $this->hasMany('App\EmployeeImmigration', 'emp_id');
    }

    public function employee_attachments()
    {
        return $this->hasMany('App\EmployeeAttachment', 'emp_id');
    }

    public function report_tos()
    {
        return $this->hasMany('App\EmployeeSecurityGroup', 'emp_id');
    }

    public function working_day()
    {
        return $this->hasOne('App\EmployeeWorkingDay', 'emp_id');
    }

    public function attendances()
    {
        return $this->hasMany('App\EmployeeAttendance', 'emp_id');
    }
}
