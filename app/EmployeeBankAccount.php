<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeBankAccount extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_bank_accounts';

    protected $fillable = [
        'bank_code',
        'acc_no',
        'acc_status',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
