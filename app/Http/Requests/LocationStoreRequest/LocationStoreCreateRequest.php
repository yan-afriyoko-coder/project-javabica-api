<?php

namespace App\Http\Requests\LocationStoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class LocationStoreCreateRequest extends FormRequest
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
            
            'name'                   =>   'required',
            'fk_province'            =>   'nullable',
            'image_upload'           =>   'nullable',
            'description'            =>   'required',
            'embed_map'              =>   'nullable',
    
        ];
    }
}
