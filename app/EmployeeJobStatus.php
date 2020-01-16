<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeJobStatus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_job_status';
    public $timestamps = false;
    
    public function status()
    {
        return $this->belongsTo('App\EmploymentStatus', 'status_id');
    }
}