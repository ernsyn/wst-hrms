<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    protected $fillable = [

    'name','start_date','end_date','note',
    'status',
    'repeated_manually','total_days'


    ];
}