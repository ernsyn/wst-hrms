<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socso extends Model
{
    use SoftDeletes;
    protected $table = 'socsos';
    // public $timestamps = false;

    protected $fillable = [
        'first_category_employer','first_category_employee','salary'
    ];

    protected $dates = ['deleted_at'];
}
