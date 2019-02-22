<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
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
            'code' => $this->code,
            'contact_no' => $this->contact_no,
            'address' => $this->address,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'race' => $this->race,
            'nationality' => $this->nationality,
            'marital_status' => $this->marital_status,
            'ic_no' => $this->ic_no,
            'tax_no' => $this->tax_no,
            'epf_no' => $this->epf_no,
            'driver_license_no' => $this->driver_license_no,
            'driver_license_expiry_date' => $this->driver_license_expiry_date,
            'basic_salary' => $this->basic_salary,
            'profile_media_id' => $this->profile_media_id,
        ];
    }
}
