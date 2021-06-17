<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        if($this->request->get('action')=='edit'){
            $valid=array(
                'name'	=> 'required',
                'specialization'	=> 'required|',
                'email'	=> 'required|email|unique:doctors,email,'.$this->request->get("id").',id',
            );
        }else{
            $valid=array(
                'name'	=> 'required',
                'email'	=> 'required|email|unique:doctors,email,NULL,id',
                'specialization'	=> 'required|',
            );
        }
        return $valid;
    }

    public function messages() {
        return [
            'name.required'    => 'Doctor name is required',
            'email.required'    => 'Doctor email is required',
            'email.unique'		=> 'Email is already exists',
            'specialization.required'    => 'Select specialization option',
        ];
    }
}
