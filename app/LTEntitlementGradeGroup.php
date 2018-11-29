<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTEntitlementGradeGroup extends Model
{
    use SoftDeletes;
    protected $table = 'lt_entitlement_grade_groups';

    protected $fillable = [
        'entitled_days',
    ];

    protected $dates = ['deleted_at'];

    public function grades()
    {
        return $this->belongsToMany('App\EmployeeGrade', 'lt_entitlement_grade_group_grades', 'lt_entitlement_gg_id', 'grade_id');
    }

    public function lt_conditional_entitlements() {
        return $this->hasMany('App\LTConditionalEntitlement', 'lt_entitlement_gg_id')->orderBy('min_years'); 
    }
}