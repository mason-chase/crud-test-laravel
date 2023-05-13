<?php
namespace Ddd\Application\Customers\ValueObjects;

class BankAccountNumber
{
    public function __construct(private string $value) {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}