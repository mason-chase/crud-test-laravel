<?php

namespace App\Domains\Customer\Domain\Entities;

use App\Domains\Shared\Interfaces\EntityInterface;

class CustomerEntity implements EntityInterface
{
    public function __construct(
        private readonly int $id,
        private string       $firstName,
        private string       $dateOfBirth,
        private string       $lastName,
        private string       $email,
        private string       $phoneNumber,
        private string       $bankAccountNumber,
    )
    {
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setDateOfBirth(string $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setBankAccountNumber(string $bankAccountNumber): void
    {
        $this->bankAccountNumber = $bankAccountNumber;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getBankAccountNumber(): string
    {
        return $this->bankAccountNumber;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'dateOfBirth' => $this->dateOfBirth,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'bankAccountNumber' => $this->bankAccountNumber,
        ];
    }
}
