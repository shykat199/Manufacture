<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RawProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'status.required' => 'Product status is required',
            'price.required'  => 'Product price is required',
            'price.numeric'  => 'Product price should be numeric',
        ];
    }
}
