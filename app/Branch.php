<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    protected $table = 'branches';

    protected $fillable = [
        'name','contact_no_primary' ,'contact_no_secondary' ,'fax_no' ,'address',
        'country_code',
        'state',
        'city',
        'zip_code'
    ];
    protected $dates = ['deleted_at'];
}
