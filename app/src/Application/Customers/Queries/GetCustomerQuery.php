<?php
namespace Ddd\Application\Customers\Queries;

class GetCustomerQuery
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}