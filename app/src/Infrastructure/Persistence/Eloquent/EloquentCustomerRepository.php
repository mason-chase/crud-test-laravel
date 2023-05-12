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


    public function getById(int $id): ?CustomerModel
    {
        // TODO: Implement getById() method.
    }

    public function getByEmail(string $email): ?CustomerModel
    {
        // TODO: Implement getByEmail() method.
    }

    public function delete(CustomerModel $customer): void
    {
        // TODO: Implement delete() method.
    }

    public function update(CustomerModel $customer): CustomerModel
    {
        // TODO: Implement update() method.
    }
}