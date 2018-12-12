<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeClockInOutRecord extends Model
{
    use SoftDeletes;
    protected $table = 'employee_clock_in_out_records';
    
    protected $fillable = [
        'clock_in_time',
        'clock_in_lat',
        'clock_in_long',
        'clock_in_address',
        'clock_in_status',
        'clock_in_reason',
        'clock_out_time',
        'clock_out_lat',
        'clock_out_long',
        'clock_out_address',
        'clock_out_status',
        'clock_out_reason',
    ];

    protected $dates = ['deleted_at'];

    public function clock_in_image() {
        return $this->belongsTo('App\Media', 'clock_in_image_media_id');
    }

    public function clock_out_image() {
        return $this->belongsTo('App\Media', 'clock_out_image_media_id');
    }
}
