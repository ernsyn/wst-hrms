<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeWorkingDay extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'employee_working_days';

    protected $fillable = [
        'emp_id',
        'is_template',
        'template_name',
        'created_by',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'start_work_time',
        'end_work_time',
      
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('non-template', function (Builder $builder) {
            $builder->where('is_template', '!=', true);
        });
    }

    public function scopeTemplates($query)
    {
        return $query->withoutGlobalScope('non-template')->where('is_template', true);
    }
}
