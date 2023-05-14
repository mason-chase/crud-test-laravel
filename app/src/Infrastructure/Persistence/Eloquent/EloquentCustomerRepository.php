<?php

namespace Ddd\Infrastructure\Persistence\Eloquent;


use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function save(CustomerModel $customer): CustomerModel
    {
        $customer->save();
        return $customer;
    }

    public function getById($id): ?CustomerModel
    {
        return CustomerModel::findOrFail($id);
    }

    public function getByEmail(string $email): ?CustomerModel
    {
        // TODO: Implement getByEmail() method.
    }

    public function delete(int $customerId): void
    {
        $customer = CustomerModel::findOrFail($customerId);
        $customer->delete();
    }

    public function update(int $customerId, array $data): CustomerModel
    {
        $customer = CustomerModel::findOrFail($customerId);
        $customer->update($data);
        return $user = $customer->fresh();

    }

    public function getAll($orderBy, $orderDirection): array
    {
        return CustomerModel::orderBy($orderBy, $orderDirection)->get()->toArray();
    }
}