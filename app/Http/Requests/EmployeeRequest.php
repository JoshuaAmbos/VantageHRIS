<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $employeeId = $this->route('id') ?? $this->route('employee');

        // FIXED: Using fluent Rule wrappers to securely handle null/empty variables
        $emailRules = ['required', 'email', Rule::unique('employees', 'email')->ignore($employeeId)];
        $phoneRules = ['required', 'string', Rule::unique('employees', 'phone')->ignore($employeeId)];

        if ($this->isMethod('post')) {
            $emailRules[] = Rule::unique('users', 'email');
        } else {
            $employee = Employee::find($employeeId);
            $userId = $employee?->user_id;
            if ($userId) {
                // FIXED: Using fluent Rule validation wrapper here as well
                $emailRules[] = Rule::unique('users', 'email')->ignore($userId);
            }
        }

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => $emailRules,
            'phone' => $phoneRules,
            'department_id' => ['required', 'exists:departments,id'], 
            'address' => ['required', 'string'],
            'position' => ['required', Rule::in(Employee::POSITIONS)],
            'employment_status' => ['required', Rule::in(Employee::EMPLOYMENT_STATUSES)],
            'hire_date' => ['required', 'date', 'before_or_equal:today'],
        ];
    }
}