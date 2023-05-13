<?php

namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Queries\EditCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class EditCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(EditCustomerQuery $query): ?CustomerModel
    {
        return $this->customerRepository->getById($query->getId());
    }
}