<?php

namespace Src\Customer\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Application\Rules\PhoneNumberRule;
use Symfony\Component\HttpFoundation\Response;

class StoreCustomerRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $isExists = $this->customerService->checkExistenceByFields([
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
            'date_of_birth' => $this->input('date_of_birth')
        ]);

        if ($isExists) {
            throw ValidationException::withMessages([
                'customer_exists' => 'Customer exists!!',
            ]);
        }
    }

    public function __construct(protected CustomerServiceInterface $customerService)
    {
        parent::__construct();
    }

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
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'phone_number' => ['required', 'string', 'min:2', new PhoneNumberRule('IR')],
            'email' => ['required', 'email', Rule::unique('customers', 'email')],
            'bank_account_number' => ['required']
        ];
    }
}
