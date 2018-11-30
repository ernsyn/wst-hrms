<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTrxDeduction extends Model
{
    protected $table = 'payroll_trx_deduction';
    
    public function payrollTrx()
    {
        return $this->belongsTo('App\PayrollTrx');
    }
    
    public function deductionMaster()
    {
        return $this->belongsTo('App\DeductionMaster');
    }
}
