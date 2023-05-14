<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Queries\GetAllCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;

class GetAllCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(GetAllCustomerQuery $query): array
    {
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();

        return $this->customerRepository->getAll($orderBy, $orderDirection);
    }
}