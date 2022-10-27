<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'year' => 'required|digits:4',
            'start_month' => 'nullable|numeric',
            'end_month' => 'nullable|numeric',
            'honour_cutoff' => 'nullable|numeric',
            'exam_full_mark' => 'nullable|numeric',
            'total_number_of_sunday_schools' => 'nullable|numeric',
        ];
    }
}
