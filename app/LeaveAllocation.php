<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveAllocation extends Model
{
    use SoftDeletes;
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
        'created_by'
        
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
