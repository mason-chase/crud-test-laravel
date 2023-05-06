<?php

namespace Src\Customer\Application\Items\Queries;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class IsCustomerExistsQuery
{

    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(array $field)
    {
        return $this->customerRepository->checkCustomerExistence($field);
    }
}
