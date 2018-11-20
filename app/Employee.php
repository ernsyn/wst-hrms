<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function employee_jobs()
    {
        return $this->hasMany('App\EmployeeJob', 'emp_id');
    }

    protected $fillable = [
        'user_id', 'address', 'company_id','contact_no','dob',
        'gender','race','nationality','marital_status','total_children','ic_no','tax_no',
        'epf_no','driver_license_no','driver_license_expiry_date','created_by'
    ];


}
