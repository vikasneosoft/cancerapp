<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CancerRequest extends FormRequest
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
                'name'	=> 'required|unique:cancer_types,name,'.$this->request->get("id").',id',
            );
        }else{
            $valid=array(
                'name'	=> 'required|unique:cancer_types,name,NULL,id',
            );
        }
        return $valid;
    }

    public function messages() {
        return [
            'name.required'    => 'Cancer type name is required',
            'name.unique'		=> 'Cancer type name already exists'
        ];
    }
}
