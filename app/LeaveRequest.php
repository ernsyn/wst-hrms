<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveRequest extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_requests';

    protected $fillable = [
        'emp_id',
        'leave_type_id',
        'leave_allocation_id',
        'start_date',
        'end_date', 
        'am_pm', 
        'applied_days',
        'reason',
        'status' 
    ];

    protected $casts = [
        'applied_days' => 'float',
    ];

    protected $dates = ['deleted_at'];

    public function approvals() 
    {
        return $this->hasMany('App\LeaveRequestApproval'); 
    }

    public function attachment() 
    {
        return $this->belongsTo('App\Media', 'attachment_media_id'); 
    }

    public function report_to()
    {
        return $this->hasMany('App\EmployeeReportTo','emp_id');
    }

    public function leave_type() 
    {
        return $this->belongsTo('App\LeaveType','leave_type_id'); 
    }

    public function employee() 
    {
        return $this->belongsTo('App\Employee','emp_id'); 
    }

    public function leave_allocation() 
    {
        return $this->belongsTo('App\LeaveAllocation','leave_allocation_id'); 
    }

    public function leave_request_approval()
    {
        return $this->hasMany('App\LeaveRequestApproval'); 
    }
}
