<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTrxAddition extends Model
{
    protected $table = 'payroll_trx_addition';
    
    protected $fillable = [
        'payroll_trx_id',
        'additions_id',
        'amount',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    
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
