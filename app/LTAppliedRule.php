<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTAppliedRule extends Model
{
    use SoftDeletes;
    protected $table = 'lt_applied_rules';

    protected $fillable = [
        'rule',
        'value',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
    
    public function applied_rule_min_apply_days_before() {
        return $this->hasMany('App\LTAppliedRuleMinApplyDaysBefore','lt_applied_rule_id');
    }
    
    public function applied_rule_carry_forwards() {
        return $this->hasMany('App\LTAppliedRuleCarryForward','lt_applied_rule_id');
    }
    
    public function applied_rule_available_to_apply_on() {
        return $this->hasMany('App\LTAppliedRuleAvailableToApplyOn','lt_applied_rule_id');
    }
}
