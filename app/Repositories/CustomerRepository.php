<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends BaseRepository implements ICustomerRepository
{
	protected $model = Customer::class;

	/**
	 * @inheritDoc
	 */
	public function createNewCustomer(
		string $firstName,
		string $lastName,
		string $dateOfBirth,
		string $phoneNumber,
		string $email,
		string $bankAccountNumber
	): Customer {
		return $this->getModel()->create(
			[
				'firstName'         => $firstName,
				'lastName'          => $lastName,
				'dateOfBirth'       => $dateOfBirth,
				'phoneNumber'       => $phoneNumber,
				'email'             => $email,
				'bankAccountNumber' => $bankAccountNumber,
			]
		);
	}
}