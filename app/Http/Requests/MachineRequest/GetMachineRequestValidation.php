<?php

namespace App\Http\Requests\MachineRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetMachineRequestValidation extends FormRequest
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

        if (Auth::user()->can('order_show')) {
            return true;
        }

        if ($this->by_email == Auth::user()->email) {
            return true;
        }
        
        if ($this->by_id) {
        
            $getMachine = Machine::find($this->by_id);
        
            if($getMachine) {

                if($getMachine->user_id == Auth::user()->id)
                {
                    return true;
                }                
            }
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
            'keyword'         =>   [
                'nullable',
            ],
            'sort_type'      => [
            'nullable',
            'in:asc,desc',
            ],
            'paginate'       =>   [
                'nullable',
                'boolean',
                'required_with:page,per_page',
            ],
            'per_page'        =>   [
                'nullable',
                'numeric',
                'required_with:paginate',
                ' required_if:paginate,1,true'
            ],
            'page'           =>   [
                'nullable',
                'numeric',
                'required_with:paginate,per_page',
                'required_if:paginate,1,true'
            
            ],
            'by_id'           =>   [
                'nullable',
                'numeric',
                'exists:machines,id'
            ],
        ];
    }
}
