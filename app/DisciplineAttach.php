<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DisciplineAttach extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'discipline_attachs';

    protected $fillable = [
        'discipline_id',
        'discipline_attach'
    ];
   
    public function discipline_attach()
    {
        return $this->belongsTo('App\EmployeeDisciplinary', 'discipline_id');
    }
   

}
