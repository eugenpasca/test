<?php

namespace App\Http\Requests\Device;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserAPIRequest extends FormRequest
{
    /**
    * @return  bool
    */
    public function authorize(): bool
    {
        return true;
    }

    /**
    * @return  array
    */
    public function rules(): array
    {
        return [
            'username' => ['nullable','string'],
            'password' => ['nullable','string'],
            'email' => ['nullable','string','unique:users,email'],
            'name' => ['nullable','string'],
            'email_verified_at' => ['nullable'],
            'is_active' => ['boolean'],
            'user_type' => ['required', Rule::in([User::TYPE_ADMIN, User::TYPE_USER])]    
        ];
    }
}
