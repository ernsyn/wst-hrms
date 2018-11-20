<?php

namespace App;


class Company extends Model
{
    protected $table = 'companies';
    
    protected $fillable = [
        'name',
        'url',
        'registration_no',
        'description',
        'address',
        'phone',
        'tax_no',
        'epf_no',
        'socso_no',
        'eis_no',
        'code',
        'status',
    ];
    
    public function payrollMaster()
    {
        return $this->hasMany('App\PayrollMaster');
    }
}