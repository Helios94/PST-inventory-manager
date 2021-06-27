<?php

namespace App\Http\Requests;

use App\Models\Food;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreFoodRequest extends FormRequest
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

//    /**
//     * Get the error messages for the defined validation rules.
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'name' => 'name ERROR',
//            'category_id' => 'category_id ERROR',
//            'image' => 'image ERROR',
//            'barcode' => 'barcode ERROR',
//            'description' => 'description ERROR',
//            'expiry_date' => 'expiry_date ERROR',
//            'quantity' => 'quantity ERROR',
//            'price' => 'price ERROR',
//            'user_id' => 'user_id ERROR',
//            'shareable' => 'shareable ERROR',
//            'storage_id' => 'storage_id ERROR',
//            'unit_id' => 'unit_id ERRORd'
//        ];
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'category_id' => 'bail|required',
            'image' => 'bail|required|image',
            'barcode' => 'bail|required|unique:food,barcode',
            'description' => 'bail|required|max:255',
            'expiry_date' => 'bail|required',
            'quantity' => 'bail|required',
            'price' => 'bail|required',
            'user_id' => 'bail|required',
            'shareable' => 'bail|required',
            'storage_id' => 'bail|required',
            'unit_id' => 'bail|required'
        ];
    }
}
