<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BankCode extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'bank_code';
    protected $fillable =[
        'name',
        'bic_code',
        'status',
        'created_by'
    ];

    public function company_bank()
    {
        return $this->hasOne('App\CompanyBank');
    }
}