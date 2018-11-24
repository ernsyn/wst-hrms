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
        'applied_days',
        'reason',
        'is_approved',
    ];

    protected $dates = ['deleted_at'];

    public function approvals() {
        return $this->hasMany('App\LeaveRequestApproval'); 
    }

    public function attachment() {
        return $this->belongsTo('App\Media'); 
    }
}
