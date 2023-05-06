<?php

namespace Src\Customer\Application\Items\Queries;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class FindCustomerByIdQuery
{

    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(int $customerId)
    {
        return $this->customerRepository->findOrFail($customerId);
    }
}
