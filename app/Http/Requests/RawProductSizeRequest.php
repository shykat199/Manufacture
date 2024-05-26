<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RawProductSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product' => 'required',
            'size' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'Product is required',
            'size.required' => 'Product size is required',
            'size.numeric'  => 'Product size should be numeric',
        ];
    }
}
