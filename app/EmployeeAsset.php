<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeAsset extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee_assets';

    protected $fillable = [
        'emp_id',
        'asset_name',
        'asset_quantity',
        'asset_spec',
        'issue_date',
        'asset_deposit',
        'return_date',
        'sold_date',
        'asset_status'
    ];
     protected $dates = [
        'issue_date',
        'return_date',
        'sold_date'
    ];


    public function employee()
    {
        return $this->belongsTo('App\Employee', 'emp_id');
    }

     public function employee_assets()
    {
        return $this->hasMany('App\AssetAttach', 'asset_id');
    }
   

}
