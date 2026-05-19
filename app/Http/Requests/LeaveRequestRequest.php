<?php

namespace App\Http\Requests;

use App\Models\LeaveRequest;
use Illuminate\Contracts\Validation\ValidationRule;
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'leave_type' => ['required', Rule::in(LeaveRequest::LEAVE_TYPES)],
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today',],
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date',],
            'reason' => 'required|string|max:255',
        ];
    }
}
