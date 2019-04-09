<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PayrollSetup extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'payroll_setup';
    
    protected $fillable = [
        'key',
        'value',
        'remark',
        'company_id',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
