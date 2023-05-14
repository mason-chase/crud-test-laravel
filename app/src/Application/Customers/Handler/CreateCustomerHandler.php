<?php

namespace Ddd\Application\Customers\Handler;


use App\src\Application\Customers\ValueObjects\FirstName;
use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\ValueObjects\BankAccountNumber;
use Ddd\Application\Customers\ValueObjects\DateOfBirth;
use Ddd\Application\Customers\ValueObjects\Email;
use Ddd\Application\Customers\ValueObjects\LastName;
use Ddd\Application\Customers\ValueObjects\PhoneNumber;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class CreateCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(CreateCustomerCommand $command): CustomerModel
    {
        $firstName = new FirstName($command->getFirstName());
        $lastName = new LastName($command->getLastName());
        $dateOfBirth = new DateOfBirth($command->getDateOfBirth());
        $email = new Email($command->getEmail());
        $bankAccountNumber = new BankAccountNumber($command->getBankAccountNumber());
        $phoneNumber = new PhoneNumber($command->getPhoneNumber());
        $customer = new CustomerModel([
            'first_name' => $firstName->getValue(),
            'last_name' => $lastName->getValue(),
            'email' => $email->getValue(),
            'bank_account_number' => $bankAccountNumber->getValue(),
            'phone_number' => $phoneNumber->getValue(),
            'date_of_birth' => $dateOfBirth->getValue()
        ]);

        return $this->customerRepository->save($customer);
    }
}