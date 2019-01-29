<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Holiday extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'holidays';

    protected $fillable = [

    'name',
    'start_date',
    'end_date',
    'note',
    'status',
    'repeat_annually',
    'total_days',
    'state',
    'created_by'


    ];
}
