<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    
    public function payrollMaster()
    {
        return $this->hasMany('App\PayrollMaster');
    }
}