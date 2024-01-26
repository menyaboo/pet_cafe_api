<?php

namespace App\Http\Request\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->ignore($this->role),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
