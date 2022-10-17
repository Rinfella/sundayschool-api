<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'person_in_charge' => 'required|numeric|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'persom_in_charge' => [
                'exists' => 'The user selected is not found!',
            ]
        ];
    }
}
