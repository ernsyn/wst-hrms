<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DepartmentHod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'department_hod';
    public $timestamps = false;
    
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
