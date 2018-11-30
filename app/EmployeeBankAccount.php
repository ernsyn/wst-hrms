<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeBankAccount extends Model
{
    use SoftDeletes;
    protected $table = 'employee_bank_accounts';

    protected $fillable = [
        'bank_code',
        'acc_no',
        'acc_status',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
}
