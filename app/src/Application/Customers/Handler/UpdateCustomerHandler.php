<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Command\UpdateCustomerCommand;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class UpdateCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(UpdateCustomerCommand $command): CustomerModel
    {
        $data = [
            'first_name' => $command->getFirstName(),
            'last_name' => $command->getLastName(),
            'email' => $command->getEmail(),
            'bank_account_number' => $command->getBankAccountNumber(),
            'phone_number' => $command->getPhoneNumber(),
            'date_of_birth' => $command->getDateOfBirth(),
        ];

        return $this->customerRepository->update($command->getId(), $data);
    }
}