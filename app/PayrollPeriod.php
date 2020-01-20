<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollPeriod extends Model
{
    protected $table = 'payroll_period';
    public $timestamps = false;
    
    public function payroll_period()
    {
        return $this->belongsTo('App\PayrollPeriod', 'payroll_period_id');
    }
}