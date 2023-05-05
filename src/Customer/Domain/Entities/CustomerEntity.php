<?php

namespace Src\Customer\Domain\Entities;

class CustomerEntity
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $dateOfBirth,
        public string $phoneNumber,
        public string $email,
        public string $bankAccountNumber
    )
    {

    }

    public static function make(array $customerData)
    {
        return new static(
            firstName: $customerData['first_name'],
            lastName: $customerData['last_name'],
            dateOfBirth: $customerData['date_of_birth'],
            phoneNumber: $customerData['phone_number'],
            email: $customerData['email'],
            bankAccountNumber: $customerData['bank_account_number']
        );
    }
}
