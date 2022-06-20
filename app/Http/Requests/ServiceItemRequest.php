<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceItemRequest extends FormRequest
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
                'title'=>'required|string|max:250',
                'excerpt'=>'required|string|min:150|max:250',
                'description'=>'required',
                'price'=>'required|numeric',
                'negotiations'=>'nullable'
        ];
    }
    // public function prepareForValidation()
    // {
    //    $this->marge([
    //        'Filed Name that not not same as Data base Field'=> $this->Database Field name
    //    ]);
    // }
    ///Then in return array changge Field name to marge Field Name;
}
