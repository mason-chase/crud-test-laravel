<?php

namespace App\Http\Requests;

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

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            'first_name' => 'string|max:60|nullable',
            'last_name' => 'required|string|max:60',
            'date_of_birth' => 'nullable|date', 
            /**
             * @TODO: add a validator class or use https://github.com/giggsey/libphonenumber-for-php
             */
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email:rfc,dns|unique:customers,email,'.$this->id,
            'bank_account_number' => 'nullable|alpha_dash|max:32',
        ];
    }
}
