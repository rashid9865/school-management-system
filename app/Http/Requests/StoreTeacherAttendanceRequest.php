<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreTeacherAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subMonths(3)->toDateString(),
            ],
            'status' => 'required|in:present,absent,leave',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i|after:time_in',
            'notes' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'date.required' => 'Date is required',
            'date.date' => 'Please enter a valid date',
            'date.before_or_equal' => 'Date must be today or in the past',
            'date.after_or_equal' => 'Date must be within the last three months',
            'status.required' => 'Attendance status is required',
            'status.in' => 'Status must be Present, Absent, or Leave',
            'time_in.date_format' => 'Time In must be in HH:MM format',
            'time_out.date_format' => 'Time Out must be in HH:MM format',
            'time_out.after' => 'Time Out must be after Time In',
            'notes.max' => 'Notes cannot exceed 500 characters',
        ];
    }
}
