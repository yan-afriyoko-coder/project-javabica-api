<?php

namespace App\Http\Requests\MachineRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Machine;
use  Illuminate\Validation\ValidationException;

class DestroyMachineRequest extends FormRequest
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
            'by_id'               =>   'required|exists:machines,id'
        ];
    }
    public function messages()
    {
        return [

            'by_id.required'      => 'machine id perlu diisi',
            'by_id.exists'        => 'machine id tidak tersedia',

        ]; 
    }
    protected function passedValidation() {

        //check if id registered as parent
        $checkdata =  Machine::where('id',$this->by_id)->first();

        if(!$checkdata) {
            throw ValidationException::withMessages([
                'id' => ['destory fail,id not match'],
            ]);
        }
    }
}