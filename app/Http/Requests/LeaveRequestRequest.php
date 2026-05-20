<?php

namespace App\Http\Requests;

use App\Models\LeaveRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeaveRequestRequest extends FormRequest
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
        $startDateRules = ['required', 'date', 'date_format:Y-m-d'];

        // Enforce future-dating exclusively during record creation tasks
        if ($this->isMethod('post')) {
            $startDateRules[] = 'after_or_equal:today';
        }

        return [
            'leave_type' => ['required', Rule::in(LeaveRequest::LEAVE_TYPES)],
            'start_date' => $startDateRules,
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'reason' => ['required', 'string', 'max:255'],
        ];
    }
}