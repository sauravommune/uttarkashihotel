<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Ensure you import the Rule class

class BookingRequest extends FormRequest
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
        $rules = [

               'full_name' => 'array|required|min:1',
               'full_name.0' => 'required|string', // Validate only the first index

              'email' => 'array|required|min:1',
              'email.0' => 'required|email', // Validate only the first index
              'gender' => 'required|array|min:1',
              'gender.0' => ['required', Rule::notIn(['Select Gender'])], // Validate only the first index

            //  'dob' => 'array|required|min:1',
            //  'dob.0' => 'required|date', 



            // 'full_name' => 'array|required|min:1',
            // 'full_name.*' => 'required|string',

            // 'email' => 'array|required|min:1',
            // 'email.*' => 'required|email',

            // 'gender' => 'required|array|min:1',
            // 'gender.*' => ['required', Rule::notIn(['Select Gender'])],

            // 'dob' => 'array|required|min:1',
            // 'dob.*' => 'required|date',

            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_no' => ['required','regex:/^[0-9]{10}$/'],      

            // 'contact_city' => 'required|string',
            // 'contact_pin_code' => 'required|string',
            // 'contact_country' => ['required', Rule::notIn(['Select Country'])],
        ];

        // Conditionally apply validation to child fields if they are present
        // $rules['child_full_name'] = 'array|nullable';
        // $rules['child_full_name.*'] = 'sometimes|required|string';

        // $rules['child_gender'] = 'array|nullable';
        // $rules['child_gender.*'] = ['sometimes', 'required', Rule::notIn(['Select Gender'])];

        // $rules['child_dob'] = 'array|nullable';
        // $rules['child_dob.*'] = 'sometimes|required|date';

        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [


            'full_name.0.required' => 'The name field is required.',
            'email.0.required' => 'The email field is required.',
            'email.0.email' => 'The email must be a valid email address.',
            'gender.0.required' => 'The gender field is required.',
            'gender.0.not_in' => 'Please select a valid gender.',
            'dob.0.required' => 'The date of birth field is required.',
            // 'dob.0.date' => 'The date of birth must be a valid date.',
        
            // 'full_name.*.required' => 'The name field is required.',
            // 'email.*.required' => 'The email field is required.',
            // 'gender.*.required' => 'The gender field is required.',
            // 'gender.*.not_in' => 'Please select a valid gender.',
            // 'dob.*.required' => 'The date of birth field is required.',
            // 'dob.*.date' => 'The date of birth must be a valid date.',
            // 'child_full_name.*.required' => 'The child name field is required.',
            // 'child_gender.*.required' => 'The child gender field is required.',
            // 'child_gender.*.not_in' => 'Please select a valid child gender.',
            // 'child_dob.*.required' => 'The child date of birth field is required.',
            // 'child_dob.*.date' => 'The child date of birth must be a valid date.',
            'contact_name.required' => 'The name field is required.',
            'contact_email.required' => 'The email field is required.',
            'contact_email.email' => 'The email must be a valid email address.',
            'contact_no.required' => 'The mobile number field is required.',
            'contact_no.regex'    => 'The mobile number must be 10 digits.',
            // 'contact_address.required' => 'The address field is required.',
            // 'contact_city.required' => 'The city field is required.',
            // 'contact_pin_code.required' => 'The pin code field is required.',
            // 'contact_country.required' => 'The country field is required.',
            // 'contact_country.not_in' => 'Please select a valid country.',
        ];
    }
}
