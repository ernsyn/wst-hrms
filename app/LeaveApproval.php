<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveApproval extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_approvals';
    
    protected $fillable = [
        'leave_transaction_id',
        'created_by'
    ];
    
    protected $dates = ['deleted_at'];
    
    public function approved_by() {
        return $this->belongsTo('App\Employee', 'created_by');
    }
    
    public function leave_approval_id(){
        
        return $this->belongsTo('App\LeaveApproval', 'leave_transaction_id');
    }
}
