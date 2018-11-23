<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'user_id', 'address', 'company_id','contact_no','dob',
        'gender','race','nationality','marital_status','total_children','ic_no','tax_no',
        'epf_no','driver_license_no','driver_license_expiry_date','created_by'
    ];




    public function user()
    {
        return $this->belongsTo('App\User');
    }

   

    public function employee_jobs()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id');
    }

    public function employee_emergency_contacts()
    {
        return $this->hasMany('App\EmployeeEmergencyContact', 'emp_id');
    }

    public function dependents()
    {
        return $this->hasMany('App\EmployeeDependent', 'emp_id');
    }

    public function report_tos()
    {
        return $this->hasMany('App\EmployeeReportTo', 'emp_id');
    }
}
