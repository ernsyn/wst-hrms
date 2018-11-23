<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityGroup extends Model
{
    protected $table = 'security_groups';

    protected $fillable =[
        'description' ,
        'name' ,
        'company_id',
        'status'
  

    ];
}