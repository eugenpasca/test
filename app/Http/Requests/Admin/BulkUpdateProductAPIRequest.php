<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdateProductAPIRequest extends FormRequest
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
            'data.*.name' => ['nullable','string'],
            'data.*.price' => ['nullable','integer'],
            'data.*.description' => ['nullable','string'],
            'data.*.is_active' => ['boolean'],
        ];
    }
}
