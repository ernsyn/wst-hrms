<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkingDay extends Model
{
    use SoftDeletes;

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