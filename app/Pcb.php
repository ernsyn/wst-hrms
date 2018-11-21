<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcb extends Model
{
    protected $table = 'pcbs';
    public $timestamps = false;

    protected $fillable = [
        'category','total_children','salary','amount'
    ];
}