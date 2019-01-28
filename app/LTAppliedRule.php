<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTAppliedRule extends Model
{
    use SoftDeletes;
    protected $table = 'lt_applied_rules';

    protected $fillable = [
        'rule',
        'configuration',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
