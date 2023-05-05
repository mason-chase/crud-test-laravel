<?php

namespace Src\Customer\Domain\Entities;

class CustomerEntity
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $date_of_birth,
        public string $phone_number,
        public string $email,
        public string $bank_account_number
    )
    {

    }

    public static function make(array $customerData)
    {
        return new static(
            first_name: $customerData['first_name'],
            last_name: $customerData['last_name'],
            date_of_birth: $customerData['date_of_birth'],
            phone_number: $customerData['phone_number'],
            email: $customerData['email'],
            bank_account_number: $customerData['bank_account_number']
        );
    }
}
