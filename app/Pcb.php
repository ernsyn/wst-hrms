<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcb extends Model
{
    use SoftDeletes;

    protected $table = 'pcbs';
    // public $timestamps = false;

    protected $fillable = [
        'category','total_children','salary','amount'
    ];

    protected $dates = ['deleted_at'];

}
