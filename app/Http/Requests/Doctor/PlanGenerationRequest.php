<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class PlanGenerationRequest extends FormRequest
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
        
        $valid=array(
            'content'	=> 'required',
        );
        
        return $valid;
    }

    public function messages() {
        return [
            'content.required'     => 'Content is required',
        ];
    }
}
