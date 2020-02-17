<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveAttach extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'leave_attachments';

    protected $fillable = [
        'leave_transaction_id',
        'attachment'
    ];
   
    
   

}
