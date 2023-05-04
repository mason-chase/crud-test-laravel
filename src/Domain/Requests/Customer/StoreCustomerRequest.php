<?php

namespace Domain\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|unique:customers,last_name',
            'last_name' => 'required|unique:customers,first_name',
            'phone_number' => 'required|digits:11|unique:customers',
            'date_of_birth' => 'required|string',
            'email' => 'required|email||unique:customers',
            'bank_account_number' => 'required|digits:16'
        ];
    }
}
