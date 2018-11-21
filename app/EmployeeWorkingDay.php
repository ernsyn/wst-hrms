<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkingDay extends Model
{
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