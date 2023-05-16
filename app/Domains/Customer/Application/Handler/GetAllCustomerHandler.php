<?php

namespace App\Domains\Customer\Application\Handler;


use App\Domains\Customer\Application\Queries\GetAllCustomerQuery;
use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

readonly class GetAllCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function handle(GetAllCustomerQuery $query): Collection
    {
        return $this->repository->getAll();
    }
}
