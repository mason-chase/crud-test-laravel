<?php

namespace Src\Customer\Application\Common\Services;

use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Domain\Entities\CustomerModel;

class CustomerService implements CustomerServiceInterface
{
    public function checkExistenceByFields(array $fields)
    {
        return CustomerModel::where($fields)->exists();
    }

}
