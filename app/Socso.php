<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socso extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'socsos';
    // public $timestamps = false;

    protected $fillable = [
        'first_category_employer',
        'first_category_employee',
        'salary',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
