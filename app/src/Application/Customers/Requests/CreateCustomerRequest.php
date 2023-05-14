<?php
namespace Ddd\Application\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use libphonenumber\PhoneNumber;

class CreateCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => [
                'required',
                'string',
                'max:25',
                'phoneNumber'
            ],
            'bank_account_number' => 'required|alpha_dash|max:36|unique:customers,bank_account_number',
        ];
    }
}