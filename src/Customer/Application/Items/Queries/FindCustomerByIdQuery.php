<?php

namespace Src\Customer\Application\Items\Queries;

use Src\Customer\Domain\Entities\CustomerModel;

class FindCustomerByIdQuery
{
    public function handle(int $customerId)
    {
        return CustomerModel::findOrFail($customerId);
    }
}
