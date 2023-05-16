<?php

namespace App\Domains\Customer\Application\Handler;


use App\Domains\Customer\Application\Commands\CreateCustomerCommand;
use App\Domains\Customer\Domain\Entities\CustomerEntity;
use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;

readonly class CreateCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function handle(CreateCustomerCommand $query): CustomerEntity
    {
        return $this->repository->create($query);
    }
}
