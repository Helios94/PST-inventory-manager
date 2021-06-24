<?php

namespace App\Http\Requests;

use App\Models\Food;
use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return $this->user()->can('create', Food::class);
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
            'name' => 'bail|required',
            'category_id' => 'bail|required',
            'image' => 'bail|required|image',
            'barcode' => 'bail|required',
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
