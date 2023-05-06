<?php

namespace Src\Customer\Application\Common\Interfaces;

interface CustomerServiceInterface
{
    public function checkExistenceByFields(array $fields);

    public function save(array $data);

    public function update(array $customerData, int $customerId);

    public function delete(int $customerId);

    public function findCustomerById(int $id);
}
