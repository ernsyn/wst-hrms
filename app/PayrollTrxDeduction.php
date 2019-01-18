<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PayrollTrxDeduction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'payroll_trx_deduction';
    
    protected $fillable = [
        'payroll_trx_id',
        'deductions_id',
        'amount',
        'days',
        'hours',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    
    public function payrollTrx()
    {
        return $this->belongsTo('App\PayrollTrx');
    }
    
    public function deductionMaster()
    {
        return $this->belongsTo('App\DeductionMaster');
    }
}
