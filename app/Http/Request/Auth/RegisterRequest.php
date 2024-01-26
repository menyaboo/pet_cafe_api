<?php

namespace App\Http\Request\Auth;

use App\Http\Request\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
            'login' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => 'required|string|min:8',
            'photo_file' => 'nullable|string',
            'api_token' => 'nullable|string',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'email_verified_at' => 'nullable|date',
            'role_id' => 'exists:roles,id',
        ];
    }
}
