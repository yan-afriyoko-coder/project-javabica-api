<?php

namespace App\Http\Requests\BlogRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'fk_category'       =>   'nullable||exists:category_blogs,id',
            'status'            =>   'required',
            'hot_news'          =>   'required',
            
        ];
    }
}
