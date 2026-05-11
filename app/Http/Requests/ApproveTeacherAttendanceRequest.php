<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveTeacherAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'approval_status' => 'required|in:approved,rejected',
            'remarks' => 'required_if:approval_status,rejected|nullable|string|max:500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'approval_status.required' => 'Approval status is required',
            'approval_status.in' => 'Please select either Approved or Rejected',
            'remarks.required_if' => 'Reason is required when rejecting',
            'remarks.max' => 'Remarks cannot exceed 500 characters',
        ];
    }
}
