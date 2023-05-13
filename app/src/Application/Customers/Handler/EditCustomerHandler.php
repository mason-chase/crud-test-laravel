<?php

namespace App\src\Application\Customers\Handler;


use App\src\Application\Customers\Queries\EditCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class EditCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(EditCustomerQuery $query): ?CustomerModel
    {
        return $this->customerRepository->getById($query->getId());
    }
}