<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
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

    public function companybank()
    {
        return $this->hasOne('App\CompanyBank');
    }

    public function securityGroup()
    {
        return $this->hasOne('App\SecurityGroup');
    }


 

    protected $dates = ['deleted_at'];
}
