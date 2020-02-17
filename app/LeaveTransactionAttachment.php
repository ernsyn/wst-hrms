<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveTransactionAttachment extends Model
{
     use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_attachments';

    protected $fillable = [
        'leave_transaction_id',
        'attachment',       
    ];
}
