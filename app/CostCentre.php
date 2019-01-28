<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CostCentre extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'cost_centres';

    protected $fillable = [
        'name',
        'seniority_pay',
        'amount',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
