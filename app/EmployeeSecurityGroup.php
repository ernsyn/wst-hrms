<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeSecurityGroup extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_security_groups';

    protected $fillable = [

        'security_group_id',
        'created_by',
        'emp_id',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

    public function security_groups()
    {
        return $this->belongsTo('App\SecurityGroup','security_group_id');
    }
}
