<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use SoftDeletes;
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

    protected $dates = ['deleted_at'];

    public function approvals() {
        return $this->hasMany('App\LeaveRequestApproval'); 
    }

    public function attachment() {
        return $this->belongsTo('App\Media', 'attachment_media_id'); 
    }

    public function report_to()
    {
        return $this->hasMany('App\EmployeeReportTo');
    }

    public function leave_type() {
        return $this->belongsTo('App\LeaveType','leave_type_id'); 
    }
}
