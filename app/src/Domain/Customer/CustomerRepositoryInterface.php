<?php
namespace Ddd\Domain\Customer;

interface CustomerRepositoryInterface
{
    public function save(Customer $customer): void;

    public function getById(int $id): ?Customer;

    public function getByEmail(string $email): ?Customer;

    public function delete(Customer $customer): void;

    public function update(Customer $customer): void;
}