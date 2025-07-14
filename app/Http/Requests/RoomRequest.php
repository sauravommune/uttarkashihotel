<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [

    //         'hotel' => 'required',
    //         'room_type'  => 'required',
    //         'total_rooms' => 'required',
    //         'room_desc' => 'required',
    //         'gest_stay' => 'required',
    //         // 'room_size' => 'required',
    //         'measure'  => 'required',
    //         'smoking_option' => 'required',
    //         'facility' => 'required',
    //         'general_amenities' => 'required',
    //         'outdoor_views' => 'required',
    //         'food_and_drinks' => 'required',
    //         'non_refundable_rate'  => 'required',
    //         'outdoor_views' => 'required',
    //         'weekly_rate' => 'required',
    //         'guest_cancel' => 'required',
    //         'gest_stay' => 'required',
    //         'cancellation_period' => 'required',
    //         'measure_day'   => 'required',
    //         'images' => 'required|max:10',
    //         'images.*' => 'image|mimes:jpeg,png,jpg|max:10240'
    //     ];
    // }
}
