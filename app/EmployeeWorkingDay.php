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
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'start_work_time',
        'end_work_time',
        'half_1_start_work_time',
        'half_1_end_work_time',
        'half_2_start_work_time',
        'half_2_end_work_time',
        'created_by'
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
