<?php

namespace App\Http\Requests\Desktop;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductAPIRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
