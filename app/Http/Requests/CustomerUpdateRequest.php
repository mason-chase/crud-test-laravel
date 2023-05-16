<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Rules\PhoneNumberRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="CustomerUpdateRequest",
 *     title="Customer Update Request",
 *     description="Customer update request body",
 *     required={"first_name", "date_of_birth", "last_name", "email", "phone_number", "bank_account_number"},
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         maxLength=40,
 *         example="John"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         maxLength=40,
 *         example="Doe"
 *     ),
 *     @OA\Property(
 *         property="date_of_birth",
 *         type="string",
 *         format="date",
 *         example="1990-01-01"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         maxLength=150,
 *         example="johndoe@example.com"
 *     ),
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         maxLength=25,
 *         example="+1234567890"
 *     ),
 *     @OA\Property(
 *         property="bank_account_number",
 *         type="string",
 *         maxLength=36,
 *         example="1234567890"
 *     ),
 * )
 */
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
                Rule::unique(Customer::class, 'first_name')
                    ->where('last_name', $this->input('last_name'))
                    ->where('date_of_birth', $this->input('date_of_birth')),
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
            ],
        ];
    }
}
