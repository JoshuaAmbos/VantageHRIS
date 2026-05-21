<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && in_array(Auth::user()->role, ['admin', 'hr']);
    }

    /**
     * Get the validation rules that apply to the incoming form request.
     */
    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            
            'role' => [
                'required', 
                'string', 
                Rule::in([
                    User::ROLE_ADMIN,
                    User::ROLE_EMPLOYEE,
                    User::ROLE_MANAGER,
                    User::ROLE_HR,
                ])
            ],
            
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}