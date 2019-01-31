<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeImmigration extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_immigrations';

    protected $fillable = [
        'passport_no',
        'expiry_date',
        'issued_by',
        'issued_date',
        'created_by',
        'emp_id',
        'document_media_id'
    ];
    protected $dates = ['deleted_at'];
}
