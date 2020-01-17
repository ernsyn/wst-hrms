<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'teams';
    protected $fillable = [
        'name',
        'created_by'
    ];
    protected $dates = ['deleted_at'];

    public function team()
    {
        return $this->hasMany('App\SalaryStructure', 'team_id');
    }
}
