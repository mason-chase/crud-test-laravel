<?php
namespace Ddd\Domain\Customers;

use App\src\Application\Customers\Queries\GetCustomerByIdQuery;
use Ddd\Domain\Customers\Entities\CustomerModel;

interface CustomerRepositoryInterface
{
    public function save(CustomerModel $customer): CustomerModel;

    public function getById(int $id): ?CustomerModel;

    public function getByEmail(string $email): ?CustomerModel;

    public function delete(CustomerModel $customer): void;

    public function update(int $id, array $customer): CustomerModel;

    public function getAll(string $orderBy, string $orderDirection): array;

}