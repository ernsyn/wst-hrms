<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyTravelAllowance extends Model
{
    protected $table = 'company_travel_allowance';

    protected $fillable = [
        'company_id',
        'rate',
        'country_id',
        'code',
     
    ];

    public function countries()
    {
        return $this->belongsTo('App\Country');
    }


 
}