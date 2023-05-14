<?php
namespace Ddd\Domain\Events;


use Ddd\Domain\Customers\Entities\CustomerModel;

class CustomerCreated
{
    public function __construct(public CustomerModel $customer)
    {
    }
}