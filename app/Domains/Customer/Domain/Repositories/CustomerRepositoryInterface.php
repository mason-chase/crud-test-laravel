<?php

namespace App\Domains\Customer\Domain\Repositories;

use App\Domains\Customer\Application\Commands\CreateCustomerCommand;
use App\Domains\Customer\Application\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Application\Commands\UpdateCustomerCommand;
use App\Domains\Customer\Domain\Entities\CustomerEntity;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): CustomerEntity;

    public function create(CreateCustomerCommand $query): CustomerEntity;

    public function update(UpdateCustomerCommand $query): bool;

    public function deleteById(DeleteCustomerCommand $query): bool;
}
