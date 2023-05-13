<?php
namespace Ddd\Application\Customers\ValueObjects;

class DateOfBirth
{public function __construct(private string $value) {
}


    public function getValue(): string
    {
        return $this->value;
    }
}