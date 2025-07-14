<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email,' . $this->route('manager'),
            'phone' => 'nullable|string|max:15',
            'hotel_id' => 'required|integer|exists:hotels,id', // Assuming a manager belongs to a hotel
            'address' => 'nullable|string|max:500',
            'salary' => 'nullable|numeric|min:0',
            'hired_at' => 'nullable|date',
            'image' => 'nullable|file|image|max:2048', // 2MB max per image
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email has already been taken.',
            'hotel_id.required' => 'The hotel field is required.',
            'hotel_id.exists' => 'The selected hotel is invalid.',
            'salary.numeric' => 'The salary must be a numeric value.',
            'hired_at.date' => 'The hired at field must be a valid date.',
            'image.image' => 'The image must be a valid image file.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
