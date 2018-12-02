<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCode extends Model
{
    protected $table = 'bank_code';
    protected $fillable =[
      
     
        'name',
        'status',
        'created_by'
    ];


    public function company_bank()
    {
        return $this->hasOne('App\CompanyBank');
    }

  
}