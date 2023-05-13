<?php
namespace App\src\Application\Customers\Handler;


use App\src\Application\Customers\Queries\GetAllCustomerQuery;
use Ddd\Application\Customers\Queries\GetCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;

class GetAllCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(GetAllCustomerQuery $query): array
    {
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();

        return $this->customerRepository->getAll($orderBy, $orderDirection);
    }
}