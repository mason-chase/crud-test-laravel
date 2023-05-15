<?php

namespace Test\CustomerManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'int', 'min:1', 'max:2000'],
            'filters' => ['sometimes', 'array'],
            'filters.filter' => ['sometimes', 'string', 'min:3', 'max:200'],
            'filters.accountNumbers' => ['sometimes', 'array'],
            'filters.accountNumbers.*' => ['required', 'int', 'exists:customers,bank_account_number'],
            'filters.emails' => ['sometimes', 'array'],
            'filters.emails.*' => ['required', 'int', 'exists:customers,email'],
        ];
    }
}
