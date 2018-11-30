<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EPF extends Model
{
    use SoftDeletes;
    protected $table = 'epfs';
    // public $timestamps = false;

    protected $fillable = [
        'name','category','employer','employee','salary'
    ];
    protected $dates = ['deleted_at'];
}
