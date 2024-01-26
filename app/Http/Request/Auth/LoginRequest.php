<?php

namespace App\Http\Request\Auth;

use App\Http\Request\ApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
