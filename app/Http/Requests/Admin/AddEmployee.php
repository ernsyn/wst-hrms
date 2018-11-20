<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            'company_id' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'race' => 'required',
            'nationality' => '',
            'marital_status' => '',
            'total_children' => '',
            'ic_no' => 'required',
            'tax_no' => 'required',
            'epf_no' => 'required',
            'driver_license_number',
            'driver_license_expiry_date',
        ];
    }
}
