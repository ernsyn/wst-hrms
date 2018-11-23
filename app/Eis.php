<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Eis extends Model
{
    protected $table = 'eis';
   

    protected $fillable = [
        'employer','employee','salary'
    ];
}