<?php
namespace Ddd\Domain\Events;


use Ddd\Domain\Customers\Entities\CustomerModel;

class CustomerCreated
{
    public $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }
}