<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatePlansRequest extends FormRequest
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
            // 'start_date'    => 'required|date',
            // 'end_date'      => 'required|date|after:start_date',
            'b2b_rate_ep' => 'required|numeric|gt:0',
            'b2b_rate_cp' => 'required|numeric',
            'b2b_rate_map' => 'required|numeric',
            'non_refundable_rate' => 'required|numeric',
            'weekly_rate' => 'required|numeric',
            'no_of_extra_beds' => 'required_if:is_extra_bed_allowed,on',
            'no_of_extra_person' => 'required_if:is_extra_person_allowed,on',
            'min_child_age' => 'required_if:child_with_bed,on',
        ];
    }

    public function messages()
    {
        return [
            'no_of_extra_beds.required_if' => 'No of Extra Beds is required.',
            'no_of_extra_person.required_if' => 'No of Allowed Person is required.',
            'min_child_age.required_if' => 'Min Child Age is required.',
        ];
    }
}
