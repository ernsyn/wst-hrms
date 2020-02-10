<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LTAppliedRuleMinApplyDaysBefore extends Model
{
	protected $table = 'lt_applied_rule_min_apply_days_before';
	
	public $timestamps = false;
    
	public function applied_rule_min_apply_days_before() {
	    return $this->belongsTo('App\LTAppliedRule','lt_applied_rule_id');
	}
}
