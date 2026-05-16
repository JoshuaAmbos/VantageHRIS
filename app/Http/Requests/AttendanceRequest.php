<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use Illuminate\Contracts\Validation\ValidationRule;
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'time_in' => ['required', 'date_format:H:i'],
            'time_out' => ['required', 'date_format:H:i', 'after:time_in'],
            'status' => ['required', Rule::in(Attendance::STATUSES)],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom error messages for defined validation rules.
     */
    public function messages(): array
    {
        return [
            'time_out.after' => 'The time out must be a later time than the time in.',
            'employee_id.exists' => 'The selected employee record does not exist in our system.',
        ];
    }
}
