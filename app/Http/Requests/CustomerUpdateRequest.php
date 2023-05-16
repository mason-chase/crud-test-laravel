<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Rules\PhoneNumberRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:40',
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'last_name' => [
                'required',
                'string',
                'max:40',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique(Customer::class, 'email'),
                'max:150'
            ],
            'phone_number' => [
                'required',
                'string',
                'max:25',
                new PhoneNumberRule(),
            ],
            'bank_account_number' => [
                'required',
                'alpha_dash',
                'max:36',
                Rule::unique(Customer::class, 'bank_account_number'),
            ],
        ];
    }
}
