<?php

namespace App\Domains\Customer\Application\Handler;


use App\Domains\Customer\Application\Commands\UpdateCustomerCommand;
use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;

readonly class UpdateCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function handle(UpdateCustomerCommand $query): bool
    {
        return $this->repository->update($query);
    }
}
