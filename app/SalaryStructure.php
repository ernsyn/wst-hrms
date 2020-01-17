<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SalaryStructure extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'salary_structures';

    protected $fillable = [
        'team_id',
        'grade_id',
        'categories_id',
        'basic_salary',
        'KPI'
    ];
   
    public function team()
    {
        return $this->belongsTo('App\Team', 'team_id');
    }
    public function grade()
    {
        return $this->belongsTo('App\EmployeeGrade', 'grade_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'categories_id');
    }
   

}
