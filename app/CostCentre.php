<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostCentre extends Model
{
    protected $table = 'cost_centres';

    protected $fillable = [
        'name','seniority_pay','amount'
    ];
}
