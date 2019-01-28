<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SecurityGroup extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'security_groups';

    protected $fillable =[
        'name',
        'description',
        'company_id'
    ];


    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }


}
