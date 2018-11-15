<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollMaster extends Model
{
    protected $table = 'payroll_master';
    
    /*
     * Get payroll trx
     * one-to-many relationship
     */ 
    /* public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    } */
    
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
