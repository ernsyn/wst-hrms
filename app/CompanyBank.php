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
        'account_name',
        'status',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
    public function bankCode()
    {
        return $this->belongsTo('App\BankCode');
    }
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
