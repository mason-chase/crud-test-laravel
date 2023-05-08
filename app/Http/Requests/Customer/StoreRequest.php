<?php

namespace App\Http\Requests\Customer;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
			'firstName'         => [ 'required', 'max:32' ],
			'lastName'          => [ 'required', 'max:32' ],
			'dateOfBirth'       => [ 'required', 'date' ],
			'phoneNumber'       => [ 'required', new PhoneNumber() ],
			'email'             => [ 'required', Rule::unique('customers','email')->ignore(request()->id,'id') ],
			'bankAccountNumber' => [ 'required' ],
		];
	}
}
