<?php

namespace Src\Customer\Application\List\Queries;

use Src\Customer\Domain\Entities\CustomerModel;

class GetCustomersListQuery
{
    public function handle()
    {
        return CustomerModel::paginate(25);
    }
}
