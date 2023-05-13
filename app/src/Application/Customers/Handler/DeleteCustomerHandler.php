<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Command\DeleteCustomerCommand;
use Ddd\Domain\Customers\CustomerRepositoryInterface;

class DeleteCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(DeleteCustomerCommand $command): void
    {
        $this->customerRepository->delete($command->getId());
    }
}