<?php

namespace App\Http\Requests\VoucherRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VoucherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->hasRole('super_admin')) 
        {
            return true;
        }
        
        if (Auth::user()->can('order_update')) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'code'          => 'nullable|unique:vouchers,code',
            'description'   => 'required',
            'type'          => 'required',
            'amount'        => 'required',
            'start_date'    => 'nullable',
            'end_date'      => 'nullable',
            'max_usage'     => 'nullable',
            'is_active'     => 'required',
        ];
    }
}