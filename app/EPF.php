<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EPF extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'epfs';
    // public $timestamps = false;

    protected $fillable = [
        'name',
        'category',
        'employer',
        'employee',
        'salary',
        'created_by'
    ];
    protected $dates = ['deleted_at'];
}
