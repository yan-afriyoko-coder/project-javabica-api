<?php

namespace App\Http\Requests\BlogRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
        return  [
            'cover'             =>   'nullable',  
            'title'             =>   'required',
            'fk_category'       =>   'required',
            'status'            =>   'required',
            'id'                =>   'required|exists:blogs,id',
            'hot_news'          =>   'required',
            
        ];
    }
}
