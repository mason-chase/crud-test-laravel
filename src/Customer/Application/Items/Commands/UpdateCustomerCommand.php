<?php

namespace Src\Customer\Application\Items\Commands;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerEntity;

class UpdateCustomerCommand
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(array $data, $customer)
    {
        $customerEntity = CustomerEntity::make($data);

        return $this->customerRepository->update($customerEntity, $customer);

    }
}
