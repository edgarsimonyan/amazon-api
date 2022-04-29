<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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

    public function messages()
    {
        return [
            'images.required' => 'Please Check Image',
        ];
    }

    public function rules()
    {
        return [
            'product_name' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'category_status' => 'required',
            'images.*' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
