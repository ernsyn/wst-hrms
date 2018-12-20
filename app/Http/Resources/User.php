<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Employee as EmployeeResource;

use App\Http\Resources\Media as MediaResource;

use App\Http\Resources\Country as CountryResource;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'employee' => new EmployeeResource($this->employee),
            'media' => new MediaResource($this->medias),
            'country' => new CountryResource($this->employee->employee_countries),
        ];
    }
}
