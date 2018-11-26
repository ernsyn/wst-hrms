<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTEntitlementGradeGroup extends Model
{
    use SoftDeletes;
    protected $table = 'lt_conditional_entitlement_grade_groups';

    protected $fillable = [
        'entitled_days',
    ];

    protected $dates = ['deleted_at'];

    public function grades()
    {
        return $this->belongsToMany('App\EmployeeGrade', 'lt_entitlement_grade_group_grades');
    }
}