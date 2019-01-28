<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveType extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'leave_types';

    protected $fillable = [
        'code',
        'name',
        'description',
        'is_custom',
        'entitled_days',
        'active',
        'created_by',
    ];

    protected $dates = ['deleted_at'];

    public function applied_rules() {
        return $this->hasMany('App\LTAppliedRule'); 
    }

    public function lt_conditional_entitlements() {
        return $this->hasMany('App\LTConditionalEntitlement')->orderBy('min_years'); 
    }

    public function lt_entitlements_grade_groups() {
        return $this->hasMany('App\LTEntitlementGradeGroup'); 
    }

    public function scopeCustom($query)
    {
        return $query->where('is_custom', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_custom', false);
    }
}
