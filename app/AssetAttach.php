<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AssetAttach extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'asset_attachs';

    protected $fillable = [
        'asset_id',
        'asset_attach'
    ];
   
    public function employee_asset()
    {
        return $this->belongsTo('App\EmployeeAsset', 'asset_id');
    }
   

}
