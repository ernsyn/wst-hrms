<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TaskStatus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'task_status';

    protected $fillable =[
        'task' ,
        'status'
    ];
}