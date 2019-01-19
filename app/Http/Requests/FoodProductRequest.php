<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FoodProductRequest extends Request
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
            'fcode' => 'required|min:6',
            'fname' => 'required|min:5',
            'fmanufacture' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'fcode.required' => 'Food Code is required',
//            'fcode.unique' => 'Food Code must unique',
            'fcode.min' => 'Food Code at least have 6 digits',
            'fname.required' => 'Food Name is required',
            'fname.min' => 'Food Name at least have 5 character',
            'fmanufacture.required' => 'Food Manufacture is required',
            'fmanufacture.min' => 'Food Manufacture at least have 3 character',
//            'ingredient_list.required' => 'Food Ingredient is required'
        ];
    }
}
