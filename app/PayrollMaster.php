<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PayrollMaster extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'payroll_master';

    /*
     * Get payroll trx
     * one-to-many relationship
     */
    public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
