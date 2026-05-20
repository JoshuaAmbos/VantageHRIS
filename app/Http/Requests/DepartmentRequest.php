<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'string', 'max:255', "unique:departments,name,{$departmentId}"],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}