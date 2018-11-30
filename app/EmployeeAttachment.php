<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'employee_attachments';
    protected $fillable = [
        'name',
        'notes',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
