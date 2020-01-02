<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'contact_no_primary',
        'contact_no_secondary' ,
        'fax_no' ,
        'address',
        'address2',
        'address3',
        'country_code',
        'state',
        'city',
        'zip_code',
        'area_id',
        'state_holiday',
        'longitude',
        'latitude'
    ];
    protected $dates = ['deleted_at'];
    
    public function area()
    {
        return $this->belongsTo('App\Area', 'area_id');
    }
}
