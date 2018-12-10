<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = 'companies';
    
    protected $fillable = [
        'name',
        'url',
        'registration_no',
        'description',
        'address',
        'address2',
        'address3',
        'phone',
        'tax_no',
        'epf_no',
        'socso_no',
        'eis_no',
        'code',
        'status',
    ];

	protected $dates = ['deleted_at'];    
    
    public function payrollMaster()
    {
        return $this->hasMany('App\PayrollMaster');
    }

	public function companybank()
    {
        return $this->hasOne('App\CompanyBank');
    }

    public function securityGroup()
    {
        return $this->hasOne('App\SecurityGroup');
    }
}
