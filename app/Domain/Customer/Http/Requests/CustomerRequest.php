<?php

namespace App\Domain\Customer\Http\Requests;

use App\Domain\Customer\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CustomerRequest extends BaseRequest
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
        $customerUuid = $this->route('customer')?->uuid;

        return [
            'email' => [
                'required',
                'email',
                Rule::unique(Customer::TABLE_NAME)->ignore($customerUuid, Customer::COL_UUID)
            ],
            'first_name' => [
                'required',
                Rule::unique(Customer::TABLE_NAME)
                ->ignore($customerUuid, Customer::COL_UUID)
                ->where('last_name', $this->last_name)
                ->where('date_of_birth', $this->date_of_birth)
            ],
            'last_name' => [
                'required',
                Rule::unique(Customer::TABLE_NAME)
                    ->ignore($customerUuid, Customer::COL_UUID)
                    ->where('first_name', $this->first_name)
                    ->where('date_of_birth', $this->date_of_birth)
            ],
            'date_of_birth' => [
                'required',
                'date',
                Rule::unique(Customer::TABLE_NAME)
                    ->ignore($customerUuid, Customer::COL_UUID)
                    ->where('last_name', $this->last_name)
                    ->where('first_name', $this->first_name)
            ],
            'phone_number' => ['required', 'phone'],
            'bank_account_number' => ['required', 'numeric'],
        ];
    }
}
