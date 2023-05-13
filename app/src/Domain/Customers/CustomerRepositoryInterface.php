<?php
namespace Ddd\Domain\Customers;

use Ddd\Domain\Customers\Entities\CustomerModel;

interface CustomerRepositoryInterface
{
    public function save(CustomerModel $customer): CustomerModel;

    public function getById(int $id): ?CustomerModel;

    public function getByEmail(string $email): ?CustomerModel;

    public function delete(int $customerId): void;

    public function update(int $customerId, array $data): CustomerModel;

    public function getAll(string $orderBy, string $orderDirection): array;

}