<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTConditionalEntitlement extends Model
{
    use SoftDeletes;
    protected $table = 'lt_conditional_entitlements';

    protected $fillable = [
        'min_years',
        'entitled_days',
    ];

    protected $dates = ['deleted_at'];
}
