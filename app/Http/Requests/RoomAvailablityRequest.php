<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomAvailablityRequest extends FormRequest
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
            'available_from' => 'required|date',
            'available_to' => 'required|after_or_equal:available_from',
            'available_room' => 'required|integer|lte:total_room',
            'hotel' => 'required'
        ];
    }
}
