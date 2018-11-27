<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SecurityGroup extends Model
{
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
