<?php

namespace Src\Customer\Infrastructure\Persistence;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerEntity;
use Src\Customer\Domain\Entities\CustomerModel;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function isCustomerExists(array $fields): bool
    {
        return CustomerModel::where($fields)->exists();
    }

    public function store(CustomerEntity $customerEntity)
    {
        return CustomerModel::createWithAttributes($customerEntity);
    }

    public function update(CustomerEntity $customerData, $customerResource)
    {
        CustomerModel::updateWithAttributes($customerData, $customerResource);

        $customerDataArr = (array) $customerData;

        unset($customerDataArr['uuid']);

        return $customerResource->update($customerDataArr);
    }

    public function delete($customerResource)
    {
        CustomerModel::deleteCustomer($customerResource);

        return $customerResource->delete();
    }
}
