<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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

        $uniqueEmailRule = Rule::unique('customers', 'email');

        if ($this->isMethod('put')){
            $uniqueEmailRule = $uniqueEmailRule->ignore($this->route('customer')->id);
        }

        return [
            'first_name' => ['required', 'max:128'],
            'last_name' => ['required', 'max:128'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:now'],
            'phone_number' => ['required', 'phone'],
            'email' => ['required', 'email', $uniqueEmailRule],
            'bank_account_number' => ['required', 'max:32'],
        ];
    }
}
