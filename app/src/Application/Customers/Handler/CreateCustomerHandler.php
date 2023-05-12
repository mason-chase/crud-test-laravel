<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class CreateCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(CreateCustomerCommand $command): CustomerModel
    {
        $customer = new CustomerModel([
            'first_name' => $command->getFirstName(),
            'last_name' => $command->getLastName(),
            'email' => $command->getEmail(),
            'bank_account_number' => $command->getBankAccountNumber(),
            'phone_number' => $command->getPhoneNumber(),
            'date_of_birth' => $command->getDateOfBirth()
        ]);

        return $this->customerRepository->save($customer);
    }
}