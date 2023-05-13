<?php
namespace Ddd\Application\Customers\Handler;


use Ddd\Application\Customers\Queries\GetCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class GetCustomerHandler
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(GetCustomerQuery $query): ?CustomerModel
    {
        return $this->customerRepository->getById($query->id);
    }
}