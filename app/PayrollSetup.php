<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSetup extends Model
{
    protected $table = 'payroll_setup';
    
    protected $fillable = [
        'key',
        'value',
        'remark',
        'company_id',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
