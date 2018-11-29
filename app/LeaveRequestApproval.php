<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequestApproval extends Model
{
    use SoftDeletes;
    protected $table = 'leave_request_approvals';

    protected $fillable = [
        'approved_by_emp_id',
        'leave_request_id',
    ];

    protected $dates = ['deleted_at'];

    public function approved_by() {
        return $this->belongsTo('App\Employee', 'approved_by_emp_id'); 
    }

    public function leave_request_approval(){

        return $this->belongsTo('App\LeaveRequest', 'leave_request_id');   
    }
}
