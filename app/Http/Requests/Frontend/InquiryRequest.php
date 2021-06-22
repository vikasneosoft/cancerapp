<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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

        $valid = array(
            'name'    => 'required|regex:/^[a-zA-ZÑñ\s]+$/',
            'email'    => 'required|email|',
            'contact_number'    => 'required|',
            'state'    => 'required|',
            'city'    => 'required|',
            'address'    => 'required|',
            'pincode'    => 'required|',
            'cancer_type'    => 'required|',
            'document'    => 'required|max:10240',
        );

        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Name is required',
            'email.required'    => 'Email is required',
            'contact_number.required'    => 'Contact number is required',
            'state.required'    => 'State is required',
            'city.required'    => 'City is required',
            'address.required'    => 'Address is required',
            'pincode.required'    => 'Pincode is required',
            'document.required'    => 'Upload document',
            'cancer_type.required'    => 'Select cancer type',
            'document.max'    => 'Document size should be less then 10mb',

        ];
    }
}
