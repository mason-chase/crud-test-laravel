<?php

namespace App\Http\Requests;

use App\Rules\CheckPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'string|max:60|nullable',
            'last_name' => 'required|string|max:60',
            'date_of_birth' => 'nullable|date',
            'phone_number' => ['required', 'string', 'max:20', new CheckPhoneNumber()],
            'email' => 'required|email|unique:customers,email',
            'bank_account_number' => 'nullable|alpha_dash|max:32',
        ];
    }
}
