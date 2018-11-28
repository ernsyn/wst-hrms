<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSecurityGroup extends Model
{
    use SoftDeletes;
    protected $table = 'employee_security_groups';

    protected $fillable = [

        'security_group_id',
    ];

    protected $dates = ['deleted_at'];

    public function security_groups()
    {
        return $this->belongsTo('App\SecurityGroup','security_group_id');
    }
}
