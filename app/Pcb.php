<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcb extends Model
{
    use SoftDeletes;

    protected $table = 'pcbs';
    // public $timestamps = false;

    protected $fillable = [
        'category','total_children','salary','amount'
    ];

    protected $dates = ['deleted_at'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('non-template', function (Builder $builder) {
    //         $builder->where('is_template', '!=', true);
    //     });
    // }

    // public function scopeTemplates($query)
    // {
    //     return $query->withoutGlobalScope('non-template')->where('is_template', true);
    // }
}
