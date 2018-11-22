<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table = 'leave_employees_requests';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}