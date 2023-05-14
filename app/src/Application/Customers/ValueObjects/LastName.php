<?php
namespace Ddd\Application\Customers\ValueObjects;

class LastName
{
    public function __construct(private string $lastName) {}

    public function getValue(): string
    {
        return $this->lastName;
    }

}