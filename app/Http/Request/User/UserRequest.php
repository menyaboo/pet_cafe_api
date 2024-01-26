<?php

namespace App\Http\Request\User;

use App\Http\Request\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:100',
            'surname' => 'string|max:100',
            'patronymic' => 'string|max:100',
            'login' => [
                'string',
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => 'string|min:8',
            'photo_file' => 'string',
            'api_token' => 'string',
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'email_verified_at' => 'date',
            'role_id' => 'exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
