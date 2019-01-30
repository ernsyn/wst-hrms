<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveRequestApproval extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_request_approvals';

    protected $fillable = [
        'approved_by_emp_id',
        'leave_request_id',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

    public function approved_by() {
        return $this->belongsTo('App\Employee', 'approved_by_emp_id'); 
    }

    public function leave_request_approval_id(){

        return $this->belongsTo('App\LeaveRequest', 'leave_request_id');   
    }
}
