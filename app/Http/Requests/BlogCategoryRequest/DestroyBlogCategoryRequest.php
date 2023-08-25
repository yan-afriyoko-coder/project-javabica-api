<?php

namespace App\Http\Requests\BlogCategoryRequest;

use App\Models\Category_blog;
use Illuminate\Foundation\Http\FormRequest;
use  Illuminate\Validation\ValidationException;
class DestroyBlogCategoryRequest extends FormRequest
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
            'by_id'                       =>   'required'
        ];
    }
    public function messages()
    {
       return [

        'by_id.required'               => 'product id perlu diisi',
        'by_id.exists'                 => 'product id tidak tersedia',

       ]; 
    }
    protected function passedValidation() {

        $checkdata =  Category_blog::where('id',$this->by_id)->first();

        if(!$checkdata) {
            throw ValidationException::withMessages([
                'id' => ['destory fail,id not match'],
            ]);
        }
    }
}
