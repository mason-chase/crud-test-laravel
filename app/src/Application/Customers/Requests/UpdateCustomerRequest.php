<?php

namespace App\src\Application\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'last_name' => 'nullable|string|max:50',
            'email' => ['nullable', 'email', Rule::unique('customers')->ignore($this->id)],
            'phone_number' => [
                'nullable',
                'string',
                'max:25',
                'phoneNumber'
            ],
            'bank_account_number' => 'nullable|alpha_dash|max:36|unique:customers,bank_account_number',
        ];
    }
}