<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeAttachment extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_attachments';
    protected $fillable = [
        'name',
        'notes',
        'media_id',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

    public function medias()
    {
        return $this->belongsTo('App\Media', 'media_id');
    }
}
