<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LTAppliedRuleAvailableToApplyOn extends Model
{
	protected $table = 'lt_applied_rule_available_to_apply_on';
	
	public $timestamps = false;
	
	public function applied_rule_available_to_apply_on() {
	    return $this->belongsTo('App\LTAppliedRuleAvailableToApplyOn','lt_applied_rule_id');
	}
}
