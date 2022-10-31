<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fathers_name' => '',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|digits:10',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ];
    }
}
