<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class JobCompany extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'job_companies';
    
    protected $fillable = [
        'company_name',
    ];
    
    
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}

