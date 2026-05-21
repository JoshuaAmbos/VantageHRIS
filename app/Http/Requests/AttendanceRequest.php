<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $validStatuses = ['present', 'late', 'absent', 'on leave'];

        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'attendance_date' => ['required', 'date', 'date_format:Y-m-d'],
            
            'time_in' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?::[0-5]\d)?$/'],
            'time_out' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?::[0-5]\d)?$/', 'after:time_in'],
            
            'status' => ['required', Rule::in($validStatuses)],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom error messages for defined validation rules.
     */
    public function messages(): array
    {
        return [
            'time_out.after' => 'The shift time out must be a later chronologic timestamp than the time in field.',
            'employee_id.exists' => 'The selected employee record does not exist in our system.',
        ];
    }
}