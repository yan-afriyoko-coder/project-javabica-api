<?php

namespace App\Http\Requests\TaxonomyRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Interfaces\TaxonomyInterface;
use App\Models\Taxo_list;
use  Illuminate\Validation\ValidationException;

class TaxonomyDestroyRequestValidation extends FormRequest
{
    private $taxonomyInterface;

    public function __construct(TaxonomyInterface $taxonomyInterface)
    {
        $this->taxonomyInterface            = $taxonomyInterface;
    }
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
        
        if(Auth::user()->can('taxonomy_destroy')) {
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
            'by_id'                 =>   'required|exists:taxo_lists,id'
        ];
    }
    public function messages()
    {
       return [

        'by_id.required'               => 'taxonomy id perlu diisi',
        'by_id.exists'                 => 'taxonomy id tidak tersedia',

       ]; 
    }
    protected function passedValidation() {

        //check if id registered as parent

        $checkdata =  Taxo_list::where('parent',$this->by_id)->first();

        if($checkdata) {
            throw ValidationException::withMessages([
                'destroy repository' => ['this name contain child data'],
            ]);
        }
    }
}
