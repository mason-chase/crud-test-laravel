<?php

namespace Src\Customer\Application\Items\Queries;

use Src\Customer\Domain\Entities\CustomerModel;

class IsCustomerExistsQuery
{
    public function handle(array $field)
    {
        return CustomerModel::where($field)->exist();
    }
}
