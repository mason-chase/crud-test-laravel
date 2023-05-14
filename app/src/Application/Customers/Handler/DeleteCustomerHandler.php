<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Command\DeleteCustomerCommand;
use Ddd\Domain\Customers\CustomerRepositoryInterface;

class DeleteCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(DeleteCustomerCommand $command): void
    {
        $this->customerRepository->delete($command->getId());
    }
}