<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LTAppliedRuleCarryForward extends Model
{
    protected $table = 'lt_applied_rule_carry_forwards';
    
    public $timestamps = false;
    
    public function applied_rule_carry_forwards() {
        return $this->belongsTo('App\LTAppliedRuleCarryForward','lt_applied_rule_id');
    }
}
