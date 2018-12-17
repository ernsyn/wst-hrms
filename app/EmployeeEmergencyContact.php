<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEmergencyContact extends Model
{
    use SoftDeletes;
    protected $table = 'employee_emergency_contacts';

    protected $fillable = [
        'name',
        'relationship',
        'contact_no',
        'created_by'
];
    protected $dates = ['deleted_at'];
}
