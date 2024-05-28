<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseRackRequest extends FormRequest
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
                'ware_house_id'=>'required',
                'rack'=>'required|numeric',
            ];

    }

    public function messages()
    {
        return [
            'ware_house_id.required' => 'Ware house name is required',
            'rack.required' => 'Ware house rack is required',
            'rack.numeric'  => 'Ware house rack should be numeric',
        ];
    }
}
