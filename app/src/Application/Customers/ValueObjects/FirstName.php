<?php
namespace App\src\Application\Customers\ValueObjects;

class FirstName
{
    public function __construct(private string $value) {
    }

    public function getValue(): string
    {
        return $this->value;
    }

}