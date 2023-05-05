<?php

namespace Src\Customer\Application\Items\Commands;

use Src\Common\Application\Items\Commands\CreateItemCommand;
use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerEntity;

class CreateCustomerCommand extends CreateItemCommand
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(array $data)
    {
        $customer = CustomerEntity::make($data);

        return $this->customerRepository->store($customer);

    }

}
