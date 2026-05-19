<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'phone' => 'required|numeric',
            'qualification' => 'required',
            'hire_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }

    public function messages(){

        return [
             'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.regex' => 'The name may only contain letters and spaces.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'phone.required' => 'The phone field is required.',
            'qualification.required' => 'The qualification field is required.',
            'hire_date.required' => 'The hire date field is required.',
            'hire_date.date' => 'The hire date must be a valid date.',
        ];
    }
}
