<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function companybank()
    {
        return $this->hasOne('App\CompanyBank');
    }

    public function securityGroup()
    {
        return $this->hasOne('App\SecurityGroup');
    }


 
}