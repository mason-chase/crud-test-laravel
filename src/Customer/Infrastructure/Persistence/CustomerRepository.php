<?php

namespace Src\Customer\Infrastructure\Persistence;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerEntity;
use Src\Customer\Domain\Entities\CustomerModel;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(protected CustomerModel $model)
    {
    }

    public function isCustomerExists(array $fields): bool
    {
        return $this->model->where($fields)->exists();
    }

    public function store(CustomerEntity $customerEntity)
    {
        $this->model::createWithAttributes($customerEntity);

        return $this->model::create((array) $customerEntity);
    }

    public function update(CustomerEntity $customerData, $customerResource)
    {
        $this->model::updateWithAttributes($customerData, $customerResource);

        $customerDataArr = (array) $customerData;

        unset($customerDataArr['uuid']);

        return $customerResource->update($customerDataArr);
    }

    public function delete($customerResource)
    {
        $this->model::deleteCustomer($customerResource);

        return $customerResource->delete();
    }

    public function getCustomersList()
    {
        return $this->model->paginate(3);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function checkCustomerExistence(array $fields)
    {
        return $this->model->where($fields)->exists();
    }
}
