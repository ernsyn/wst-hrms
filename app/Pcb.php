<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcb extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'pcbs';
    // public $timestamps = false;

    protected $fillable = [
        'category',
        'total_children',
        'salary',
        'amount',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

}
