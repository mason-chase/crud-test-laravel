<?php

namespace Src\Customer\Application\Common\Interfaces;

use Src\Customer\Domain\Entities\CustomerEntity;

interface CustomerRepositoryInterface
{
    public function isCustomerExists(array $fields): bool;

    public function store(CustomerEntity $customerEntity);

    public function update(CustomerEntity $customerData, $customerResource);

    public function delete($customerResource);

    public function getCustomersList();

    public function findOrFail($id);

    public function checkCustomerExistence(array $fields);
}
