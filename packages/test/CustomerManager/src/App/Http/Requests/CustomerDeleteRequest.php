<?php

namespace Test\CustomerManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'int', 'exists:customers,id'],
        ];
    }
}
