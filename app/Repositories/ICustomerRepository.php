<?php

namespace App\Repositories;

use App\Models\Customer;

interface ICustomerRepository
{
	/**
	 *
	 * create new customer
	 *
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $dateOfBirth
	 * @param string $phoneNumber
	 * @param string $email
	 * @param string $bankAccountNumber
	 *
	 * @return Customer
	 */
	public function createNewCustomer(string $firstName,string $lastName,string $dateOfBirth,string $phoneNumber,string $email,string $bankAccountNumber):Customer;
}