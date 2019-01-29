<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|min:5',
                    'email' => 'required|unique:users|email',
                    'password' => 'required|required_with:confirm_password|same:confirm_password',
                    'media_id' => '',
                    'attachment' => '',
                    'attach' => 'nullable|max:2000000|regex:/^data:image/',
                    'code'=>'required|unique:employees',
                    'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
                    'address' => 'required',
                    'address2' => 'required_with:address3',
                    'address3' => 'nullable',
                    'postcode' => 'required|numeric',
                    'company_id' => 'required',
                    'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
                    'gender' => 'required',
                    'race' => 'required|alpha',
                    'nationality' => 'required',
                    'marital_status' => 'required',
                    'total_children' => 'required|numeric',
                    'ic_no' => 'required|unique:employees,ic_no|numeric',
                    'epf_no' => 'nullable|unique:employees,epf_no|numeric',
                    'epf_category' => 'required_with:epf_no',
                    'tax_no' => 'nullable|unique:employees,tax_no',
                    'pcb_group' => 'required_with:tax_no',
                    'eis_no' => 'nullable|unique:employees,eis_no|numeric',
                    'socso_no' => 'required|unique:employees,socso_no|numeric',
                    'socso_category' => 'required',
                    'driver_license_no' => 'nullable',
                    'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
                    'main_security_group_id'=>'required',
                    'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.',
                    'attach.max' => 'The file size may not be greater than 2MB.'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|min:5',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                   /*  'ic_no' => 'required|numeric|unique:employees,ic_no,'.$id.',id',
                    'code'=>'required|unique:employees,code,'.$id.',id',
                    'dob' => 'required|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
                    'gender' => 'required',
                    'marital_status' => 'required',
                    'race' => 'required|alpha',
                    'pcb_group' => 'required',
                    'total_children' => 'required|numeric',
                    'address' => 'required',
                    'address2' => 'required_with:address3',
                    'address3' => 'nullable',
                    'postcode' => 'required|numeric',
                    'driver_license_no' => 'nullable',
                    'driver_license_expiry_date' => 'nullable|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
                    'tax_no' => 'required|unique:employees,tax_no,'.$id.',id',
                    'epf_no' => 'required|numeric|unique:employees,epf_no,'.$id.',id',
                    'eis_no' => 'required|numeric|unique:employees,eis_no,'.$id.',id',
                    'socso_no' => 'required|numeric|unique:employees,socso_no,'.$id.',id',
                    'main_security_group_id'=>'',
                    'contact_no' => 'required|regex:/^01?[0-9]\-*\d{7,8}$/',
                    'nationality' => 'required',
                    // 'contact_no' => 'required|regex:/^[0-9]+-/',
                    'address2.required_with' => 'Address Line 2 field is required when Address Line 3 is present.' */
                ];
            default:
                break;
        }
    }
    
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code' => 'employee id',
            'dob' => 'date of birth',
            'total_children' => 'number of children',
            'company_id' => 'company',
            'main_security_group' => 'security group'
        ];
    }
}
