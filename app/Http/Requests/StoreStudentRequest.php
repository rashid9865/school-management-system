<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'last_name' =>  'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'nullable|email',
            'date_of_birth' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'address' => 'required',
            'father_first_name' =>  'nullable|string|max:255',
            'father_last_name' =>  'nullable|string|max:255',
            'phone_no' => 'nullable|string|max:20',
            'father_email' => 'nullable|email',
            'father_age' => 'nullable|integer|min:1|max:100',
            'father_address' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'mother_first_name' => 'nullable|string|max:255',
            'mother_last_name' => 'nullable|string|max:255',
            'mother_phone_no' => 'nullable|string|max:20',
            'mother_age' => 'nullable|integer|min:1|max:100',
            'mother_address' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'first_name.regex' => 'The first name may only contain letters and spaces.',
            'last_name.regex' => 'The last name may only contain letters and spaces.',
            'phone_no.regex' => 'The phone number may only contain digits, spaces, dashes, and parentheses.',
            'father_phone_no.regex' => 'The father\'s phone number may only contain digits, spaces, dashes, and parentheses.',
            'mother_phone_no.regex' => 'The mother\'s phone number may only contain digits, spaces, dashes, and parentheses.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'father_age.integer' => 'The father\'s age must be an integer.',
            'father_age.min' => 'The father\'s age must be at least 1.',
            'father_age.max' => 'The father\'s age may not be greater than 100.',
            'mother_age.integer' => 'The mother\'s age must be an integer.',
            'mother_age.min' => 'The mother\'s age must be at least 1.',
            'mother_age.max' => 'The mother\'s age may not be greater than 100.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 3000 kilobytes.',
            'email.email' => 'The email must be a valid email address.',
            'father_email.email' => 'The father\'s email must be a valid email address.',
            'mother_email.email' => 'The mother\'s email must be a valid email address.',
            'address.required' => 'The address field is required.',
            'father_first_name.max' => 'The father\'s first name may not be greater than 255 characters.',
            'father_last_name.max' => 'The father\'s last name may not be greater than 255 characters.',
            'father_address.max' => 'The father\'s address may not be greater than 255 characters.',
            'father_occupation.max' => 'The father\'s occupation may not be greater than 255 characters.',
            'mother_first_name.max' => 'The mother\'s first name may not be greater than 255 characters.',
            'mother_last_name.max' => 'The mother\'s last name may not be greater than 255 characters.',
            'mother_address.max' => 'The mother\'s address may not be greater than 255 characters.',
            'mother_occupation.max' => 'The mother\'s occupation may not be greater than 255 characters.',
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'address.required' => 'The address field is required.',
        ];
    }
    
}
