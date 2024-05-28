<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'rawProductId'=>'required',
            'rawProductSize'=>'required',
            'productQty'=>'required',
            'productWeight'=>'required',
            'productPrice'=>'required',
            'productTotalPrice'=>'required',
            'productWareHouseId'=>'required',
            'productWareHouseRackId'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'rawProductId.required' => 'Product name is required',
            'rawProductSize.required' => 'Product size is required',
            'productQty.required' => 'Product quantity is required',
            'productWeight.required' => 'Product weight is required',
            'productPrice.required' => 'Product price is required',
            'productTotalPrice.required' => 'Total product price is required',
            'productWareHouseId.required' => 'Product warehouse is required',
            'productWareHouseRackId.required' => 'Product warehouse rack is required',

        ];
    }
}
