<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Media extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'medias';

    protected $fillable = [
        'category',
        'mimetype',
        'data',
        'size',
        'filename',
    ];

    protected $auditExclude = ['data'];
}