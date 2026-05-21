<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // FIXED: Imported the fluent Rule engine

class DepartmentRequest extends FormRequest
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
        $departmentId = $this->route('id') ?? $this->route('department');

        return [
            'name' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('departments', 'name')->ignore($departmentId)
            ],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}