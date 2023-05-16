<?php

namespace App\Domains\Customer\Application\Commands;

readonly class DeleteCustomerCommand
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
