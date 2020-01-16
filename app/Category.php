<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
    public function category()
    {
        return $this->hasMany('App\SalaryStructure', 'categories_id');
    }
}
