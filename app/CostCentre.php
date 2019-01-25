<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostCentre extends Model
{
    use SoftDeletes;
    protected $table = 'cost_centres';

    protected $fillable = [
        'name',
        'seniority_pay',
        'amount',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
