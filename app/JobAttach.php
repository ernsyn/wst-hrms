<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class JobAttach extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'job_attachs';
    
    protected $fillable = [
        'emp_job_id',
        'job_attach'
    ];
    
    public function employee_job()
    {
        return $this->belongsTo('App\EmployeeJob', 'emp_job_id');
    }
    
    
}
