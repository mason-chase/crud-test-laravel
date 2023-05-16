<?php

namespace App\Domains\Customer\Application\Handler;


use App\Domains\Customer\Application\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;

readonly class DeleteCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function handle(DeleteCustomerCommand $query): bool
    {
        return $this->repository->deleteById($query);
    }
}
