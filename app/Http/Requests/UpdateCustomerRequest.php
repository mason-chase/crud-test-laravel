<?php

namespace App\Http\Requests;

use App\Rules\CheckPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:customers,id',
            'first_name' => 'string|max:60|nullable',
            'last_name' => 'required|string|max:60',
            'date_of_birth' => 'nullable|date',
            'phone_number' => ['required', 'string', 'max:20', new CheckPhoneNumber()],
            'email' => 'required|email|unique:customers,email,'.$this->id,
            'bank_account_number' => 'nullable|alpha_dash|max:32',
        ];
    }
}
