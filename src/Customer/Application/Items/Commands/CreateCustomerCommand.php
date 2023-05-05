<?php

namespace Src\Customer\Application\Items\Commands;

use Src\Common\Application\Items\Commands\CreateItemCommand;
use Src\Customer\Domain\Entities\CustomerEntity;
use Src\Customer\Domain\Entities\CustomerModel;

class CreateCustomerCommand extends CreateItemCommand
{
    public function handle(array $data)
    {
        $customer = CustomerEntity::make($data);

        CustomerModel::createWithAttributes($customer);

    }

}
