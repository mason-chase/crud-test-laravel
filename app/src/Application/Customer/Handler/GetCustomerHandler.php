<?php
namespace Ddd\Application\Customer\Handler;

use Ddd\Application\Customer\Queries\GetCustomerQuery;
use Ddd\Domain\Customer\Customer;
use Ddd\Domain\Customer\CustomerRepositoryInterface;

class GetCustomerHandler
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(GetCustomerQuery $query): ?Customer
    {
        return $this->customerRepository->getById($query->id);
    }
}