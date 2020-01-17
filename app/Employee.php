<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Employee extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'address',
        'address2',
        'address3',
        'postcode',
        'company_id',
        'contact_no',
        'dob',
        'gender',
        'race',
        'nationality',
        'marital_status',
        'pcb_group',
        'total_children',
        'ic_no',
        'tax_no',
        'epf_no',
        'epf_category',
        'eis_no',
        'socso_no',
        'socso_category',
        'driver_license_no',
        'driver_license_expiry_date',
        'created_by',
        'main_security_group_id',
        'code',
        'resignation_date',
        'personal_email',
        'spouse_name',
        'spouse_ic',
        'spouse_tax_no',
        'payment_via',
        'payment_rate',
        'category_id'
    ];

    protected $dates = [
        'dob',
        'driver_license_expiry_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profile_media()
    {
        return $this->belongsTo('App\Media', 'profile_media_id');
    }

    public function main_security_groups()
    {
        return $this->belongsTo('App\SecurityGroup', 'main_security_group_id');
    }

    public function report_to_emp_id()
    {
        return $this->belongsTo('App\EmployeeReportTo', 'user_id','report_to_emp_id');
    }

    public function employee_confirmed()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id');
    }

    public function employee_report_to()
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

    public function employee_countries()
    {
        return $this->belongsTo('App\Country', 'nationality');
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

    public function leave_request_approvals()
    {
        return $this->hasMany('App\LeaveRequestApproval', 'id','approved_by_emp_id');
    }

    public function clock_in_out_records()
    {
        return $this->hasMany('App\EmployeeClockInOutRecord', 'emp_id');
    }

    public function company()
    {
        return $this->hasMany('App\Company', 'id', 'company_id');
    }

    public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    }
    public function employee_assets()
    {
        return $this->hasMany('App\EmployeeAsset', 'emp_id');
    }
    public function employee_category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
