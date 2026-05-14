<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); 

        return [
            'first_name'        => 'required|string|max:225',
            'last_name'         => 'required|string|max:225',
            'email'             => 'required|email|unique:employees,email,' . $id,
            'phone'             => 'required|string|unique:employees,phone,' . $id,
            'department_id'     => 'required|exists:departments,id',
            'address'           => 'required|string', 
            'position'          => 'required|string',
            'hire_date'         => 'required|date|before_or_equal:now', 
            'employment_status' => 'required|string',
        ];
}
}