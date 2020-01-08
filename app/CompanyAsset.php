<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CompanyAsset extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'company_assets';

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
