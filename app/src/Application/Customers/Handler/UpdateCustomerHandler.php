<?php

namespace App\src\Application\Customers\Handler;


use App\src\Application\Customers\Command\UpdateCustomerCommand;
use App\src\Application\Customers\ValueObjects\FirstName;
use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\ValueObjects\BankAccountNumber;
use Ddd\Application\Customers\ValueObjects\DateOfBirth;
use Ddd\Application\Customers\ValueObjects\Email;
use Ddd\Application\Customers\ValueObjects\LastName;
use Ddd\Application\Customers\ValueObjects\PhoneNumber;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class UpdateCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(UpdateCustomerCommand $command): CustomerModel
    {
        $firstName = new FirstName($command->getFirstName());
        $lastName = new LastName($command->getLastName());
        $dateOfBirth = new DateOfBirth($command->getDateOfBirth());
        $email = new Email($command->getEmail());
        $bankAccountNumber = new BankAccountNumber($command->getBankAccountNumber());
        $phoneNumber = new PhoneNumber($command->getPhoneNumber());

        $customer = $this->customerRepository->getById($command->id);
        return $this->customerRepository->update($customer);
    }
}