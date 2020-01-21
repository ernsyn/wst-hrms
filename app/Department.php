<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
    
    public function hod()
    {
        return $this->hasMany('App\DepartmentHod', 'department_id');
    }
    public function department()
    {
        return $this->hasMany('App\EmployeeJob', 'department_id');
    }
}
