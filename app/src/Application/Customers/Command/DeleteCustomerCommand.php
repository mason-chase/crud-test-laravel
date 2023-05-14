<?php
namespace Ddd\Application\Customers\Command;

class DeleteCustomerCommand
{
    public function __construct(private int $customerId)
    {
    }

    public function getId()
    {
        return $this->customerId;
    }
}