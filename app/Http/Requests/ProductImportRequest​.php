<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImportRequest​ extends FormRequest
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
            'productCSV' => 'required|mimes:csv'
        ];
    }

    public function messages()
    {
        return [
            'productCSV.required' => 'Please choose a file',
            'productCSV.mimes' => 'Invalid file! Accepts CSV format only',
        ];
    }
}
