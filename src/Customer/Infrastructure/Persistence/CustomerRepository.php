<?php

namespace Src\Customer\Infrastructure\Persistence;

use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function isCustomerExists(array $fields): bool
    {
        return CustomerModel::where($fields)->exists();
    }


}
