<?php

namespace Test\CustomerManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Test\CustomerManager\App\Http\Rules\CheckCustomerFullNameDobIsUnique;
use Test\CustomerManager\App\Http\Rules\CheckCustomerMobileIsValid;

class CustomerStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:40'],
            'last_name' => ['required', 'max:80'],
            'date_of_birth' => [
                'filled', 'date', 'date_format:Y-m-d', 
                new CheckCustomerFullNameDobIsUnique(
                    $this->get('first_name'),
                    $this->get('last_name')
                    )
            ],
            'phone_number' => ['nullable', new CheckCustomerMobileIsValid],
            'email' => [
                'required', 'email', 'max:120', 'unique:customers,email'
            ],
            'bank_account_number' => [
                'filled', 'int', 'digits:10', 
                'unique:customers,bank_account_number'
            ],
        ];
    }
}
