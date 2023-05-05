<?php

namespace Src\Customer\Application\Items\Commands;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerEntity;

class DeleteCustomerCommand
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle($customer)
    {
        return $this->customerRepository->delete($customer);
    }
}
