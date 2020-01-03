<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Section extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'sections';
    
    protected $fillable = [
        'name',
    ];
    
    
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
