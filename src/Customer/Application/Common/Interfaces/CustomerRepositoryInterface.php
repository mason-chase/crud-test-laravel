<?php

namespace Src\Customer\Application\Common\Interfaces;

use Src\Customer\Domain\Entities\CustomerEntity;

interface CustomerRepositoryInterface
{
    public function isCustomerExists(array $fields): bool;

    public function store(CustomerEntity $customerEntity);
}
