<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
        // return [
        //     'name' => [
        //         'required',
        //         'max:255',
        //     ],
        //     'phone' => 'required',
        //     'email'  => 'required|unique:hotels,id,'.request('id'),
        //     'address' => 'required|string|max:255',
        //     'country' => 'required',
        //     'city' => 'required|string|max:255',
        //     'zip_code' => 'required|string|max:10',
        //     'parking_available' => 'required',
        //     'parking_comment' => 'nullable|string|max:255',
        //     'rating2' => 'nullable|integer|min:1|max:5',
        //     'description' => 'nullable|string',
        //     'google_embed_url' => 'nullable|url',
        //     'hotel_images.*' => 'required|array',
        //     'hotel_images.*' => 'nullable|file|image|max:2048', // 2MB max per image
        //     'near_by_places' => 'nullable|array',
        //     'near_by_places.*.place' => 'required_with:near_by_places|string|max:255',
        //     'near_by_places.*.distance' => 'required_with:near_by_places|string|max:255',
        //     'check_in_time' => 'required|string|max:50',
        //     'check_out_time' => 'required|string|max:50',
        //     'owner_name' => 'required|string|max:255',
        //     'middle_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'owner_contact_no' => 'required|string|max:20',
        //     'owner_email' => 'required|email|max:255',
        //     'post_code' => 'required|max:6|min:6',
        //     'cancellation_before' => 'nullable',
        //     'early_check_in_check_out' => 'nullable',
        //     'facility.*' => 'required',
        //     'cuisine.*'=>'required',
        //     'listing_type'=>'required'
            
        // ];

        // if(request('step') ==  1){

        //     return [
        //         'name' => 'required|max:255|unique:hotels,name,'.request('id'),
        //     ];
        // }
        return [
            // 'name' => [
            //     'required',
            //     'max:255',
            // ],
            // 'phone' => 'required',
            // 'email'  => 'required|unique:hotels,id,'.request('id'),
            // 'address' => 'required|string|max:255',
            // 'country' => 'required',
            // 'city' => 'required|string|max:255',
            // 'zip_code' => 'required|string|max:10',
        ];
        return [];
    }
}
