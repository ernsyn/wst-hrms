<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eis extends Model
{
    use SoftDeletes;
    protected $table = 'eis';

    protected $fillable = [
        'category', 'employer', 'employee', 'salary'
    ];

    protected $dates = ['deleted_at'];
}
