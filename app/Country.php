<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;



    
    public function country_travel_allowance()
    {
        return $this->hasOne('App\CompanyTravelAllowance');
    }
}
