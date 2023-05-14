<?php
namespace Ddd\Application\Customers\Command;

class CreateCustomerCommand
{
    public function __construct(
        private string $first_name,
        private string $last_name,
        private string $email,
        private string $bank_account_number,
        private string $phone_number,
        private string $date_of_birth,
    )
    {
    }


    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBankAccountNumber(): string
    {
        return $this->bank_account_number;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getDateOfBirth(): string
    {
        return $this->date_of_birth;
    }
}