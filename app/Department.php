<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
