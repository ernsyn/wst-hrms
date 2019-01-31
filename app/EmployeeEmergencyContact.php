<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeEmergencyContact extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'employee_emergency_contacts';

    protected $fillable = [
        'name',
        'relationship',
        'contact_no',
        'created_by',
        'emp_id'
];
    protected $dates = ['deleted_at'];
}
