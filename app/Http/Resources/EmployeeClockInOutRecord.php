<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeClockInOutRecord extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'clock_in_time' => $this->clock_in_time,
            'clock_in_lat' => $this->clock_in_lat,
            'clock_in_long' => $this->clock_in_long,
            'clock_in_address' => $this->clock_in_address,
            'clock_in_status' => $this->clock_in_status,
            'clock_in_reason' => $this->clock_in_reason,
            'clock_out_time' => $this->clock_out_time,
            'clock_out_lat' => $this->clock_out_lat,
            'clock_out_long' => $this->clock_out_long,
            'clock_out_address' => $this->clock_out_address,
            'clock_out_status' => $this->clock_out_status,
            'clock_out_reason' => $this->clock_out_reason,
        ];
    }
}
