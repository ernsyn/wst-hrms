<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveAllocation extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_allocations';

    protected $fillable = [
        'emp_id',
        'leave_type_id',
        'allocated_days',
        'spent_days',
        'carried_forward_days',
        'is_carry_forward',
        'valid_from_date',
        'valid_until_date',
        'created_by',
        'emp_job_id'
    ];

    protected $dates = ['deleted_at'];

    public function leave_type() {
        return $this->belongsTo('App\LeaveType'); 
    }

    protected $casts = [
        'valid_from_date' => 'date:d-m-Y',
        'valid_until_date' => 'date:d-m-Y',
    ];
    
}
