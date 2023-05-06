<?php

namespace Src\Customer\Application\List\Queries;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class GetCustomersListQuery
{

    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle()
    {
        return $this->customerRepository->getCustomersList();
    }
}
