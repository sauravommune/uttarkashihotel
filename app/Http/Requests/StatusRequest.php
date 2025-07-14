<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/', // Validating hex color code
            'background' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/', // Validating hex background color code
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The status name is required.',
            'color.regex' => 'The color must be a valid hex color code.',
            'background.regex' => 'The background must be a valid hex color code.',
        ];
    }
}
