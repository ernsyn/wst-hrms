<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBank extends Model
{
    protected $table = 'company_bank';

    protected $fillable =[

        'id_company_master' ,
        'bank_code',
        'account_name',
        'status',
        'created_by'

    ];

    public function bankCode()
    {
        return $this->belongsTo('App\BankCode');
    }
  

    public function company()
    {
        return $this->belongsTo('App\Company', 'id_company_master');
    }

}