<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Socso extends Model
{
    protected $table = 'socsos';
    public $timestamps = false;

    protected $fillable = [
        'first_category_employer','first_category_employee','salary'
    ];
}
