<?php

namespace Src\Customer\Application\Common\Services;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class CustomerService implements CustomerServiceInterface
{

    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function checkExistenceByFields(array $fields)
    {
        return $this->customerRepository->isCustomerExists($fields);
    }

}
