<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EPF extends Model
{
    protected $table = 'epfs';
    public $timestamps = false;

    protected $fillable = [
        'name','category','employer','employee','salary'
    ];
}