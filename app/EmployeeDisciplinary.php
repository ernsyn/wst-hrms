<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeDisciplinary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_disciplines';

    protected $fillable = [
        'discipline_title',
        'discipline_desc',
        'created_by',
        'emp_id',
        'discipline_date'
    ];

    protected $dates = ['discipline_date'];

    public function emp()
    {
        return $this->belongsTo('App\Employee', 'emp_id');
    }
    public function employee_discipline()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function discipline_attach()
    {
        return $this->hasMany('App\DisciplineAttach', 'discipline_id');
    }
}
