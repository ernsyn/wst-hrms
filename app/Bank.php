<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank_code';


    protected $fillable =[
        'name',
        'status',
        'bank_code'
    ];
}
