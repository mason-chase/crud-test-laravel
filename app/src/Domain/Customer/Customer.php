<?php
namespace Ddd\Domain\Customer;

use DateTimeImmutable;
use Illuminate\Support\Carbon;

class Customer
{


    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $bank_account_number
     * @param string $phone_number
     * @param string $date_of_birth
     */
    public function __construct(
        private string $first_name,
        private string $last_name,
        private string $email,
        private string $bank_account_number,
        private string $phone_number,
        private string $date_of_birth,
    )
    {}

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