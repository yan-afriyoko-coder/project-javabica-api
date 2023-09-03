<?php

namespace App\Http\Requests\MachineRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMachineRequest extends FormRequest
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
            'user_id'           => 'required',
            'category_machine'  => 'nullable',
            'purchase_date'     => 'nullable',
            'description'       => 'nullable',
            'id'                => 'required|exists:machines,id', 
        ];
    }
}