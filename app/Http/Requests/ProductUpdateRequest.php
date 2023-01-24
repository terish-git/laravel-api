<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter product name',
            'sku.required' => 'Please enter product SKU',
            'price.required' => 'Please enter product price',
            'price.regex' => 'Please enter valid price input',
        ];
    }
}
