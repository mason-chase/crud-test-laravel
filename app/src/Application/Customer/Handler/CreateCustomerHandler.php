<?php

namespace Ddd\Application\Customer\Handler;

use Ddd\Application\Customer\Command\CreateCustomerCommand;
use Ddd\Domain\Customer\Customer;
use Ddd\Domain\Customer\CustomerRepositoryInterface;

class CreateCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(CreateCustomerCommand $command): void
    {
        $customer = new Customer($command->getFirstName(), $command->getLastName(), $command->getEmail(), $command->getBankAccountNumber(), $command->getPhoneNumber(), $command->getDateOfBirth());

        $this->customerRepository->save($customer);

    }
}