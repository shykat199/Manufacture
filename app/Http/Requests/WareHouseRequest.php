<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseRequest extends FormRequest
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
            'name'=>'required',
            'address'=>'required',
            'staff'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ware house name is required',
            'address.required' => 'Ware house address is required',
            'staff.required' => 'Ware house staff is required',
            'staff.numeric'  => 'Ware house staff should be numeric',
        ];
    }
}
