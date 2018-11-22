<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';


    protected $fillable = [
        'name','contact_no_primary' ,'contact_no_secondary' ,'fax_no' ,'address',
        'country_code', 
        'state', 
        'city',      
        'zip_code'
    ];
}