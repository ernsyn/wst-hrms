<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTrxAddition extends Model
{
    protected $table = 'payroll_trx_addition';
    
    public function payrollTrx()
    {
        return $this->belongsTo('App\PayrollTrx');
    }
    
    public function additionMaster()
    {
        return $this->belongsTo('App\AdditionMaster');
    }
    
    public function companyTravelAllowance()
    {
        return $this->belongsTo('App\CompanyTravelAllowance');
    }
}
