<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTravelAllowance extends Model
{
    protected $table = 'company_travel_allowance';

    protected $fillable = [
        'company_id',
        'rate',
        'country_id',
     
    ];




 
}