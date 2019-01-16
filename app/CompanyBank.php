<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyBank extends Model
{
    use SoftDeletes;
    protected $table = 'company_bank';
    protected $fillable =[
        'company_id' ,
        'bank_code',
        'acc_name',
        'status',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
    
    public function bank()
    {
        return $this->belongsTo('App\BankCode','bank_code');
    }
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }


}
