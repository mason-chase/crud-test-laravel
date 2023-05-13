<?php

namespace Ddd\Infrastructure\Persistence\Eloquent;


use App\src\Application\Customers\Queries\GetCustomerByIdQuery;
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

    public function delete(CustomerModel $customer): void
    {
        // TODO: Implement delete() method.
    }

    public function update(int $id, array $customer): CustomerModel
    {
        // TODO: Implement update() method.
    }

    public function getAll($orderBy, $orderDirection): array
    {
        return CustomerModel::orderBy($orderBy, $orderDirection)->get()->toArray();
    }
}