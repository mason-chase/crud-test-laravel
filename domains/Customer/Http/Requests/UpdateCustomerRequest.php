<?php

namespace Domains\Customer\Http\Requests;

use Domains\Customer\Http\Rules\CheckPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'id' => ['required', 'integer', 'exists:customers,id'],
            'first_name' => 'string|max:60|nullable',
            'last_name' => 'required|string|max:60',
            'date_of_birth' => 'nullable|date',
            'phone_number' => ['required', 'string', 'max:20', new CheckPhoneNumberRule()],
            'email' => 'required|email:rfc,dns|unique:customers,email',
            'bank_account_number' => 'nullable|alpha_dash|max:32',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
}