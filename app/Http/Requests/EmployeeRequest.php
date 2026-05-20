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

        $emailRules = ['required', 'email', "unique:employees,email,{$employeeId}"];
        $phoneRules = ['required', 'string', "unique:employees,phone,{$employeeId}"];

        if ($this->isMethod('post')) {
            $emailRules[] = 'unique:users,email';
        } else {
            $employee = Employee::find($employeeId);
            $userId = $employee?->user_id;
            if ($userId) {
                $emailRules[] = "unique:users,email,{$userId}";
            }
        }

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => $emailRules,
            'phone' => $phoneRules,
            'department_id' => ['required', 'exists:departments,id'], // Every employee must belong to a department
            'address' => ['required', 'string'],
            'position' => ['required', Rule::in(Employee::POSITIONS)],
            'employment_status' => ['required', Rule::in(Employee::EMPLOYMENT_STATUSES)],
            'hire_date' => ['required', 'date', 'before_or_equal:today'],
        ];
    }
}