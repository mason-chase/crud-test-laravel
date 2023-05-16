<?php

namespace Ddd\Application\Customers\Queries;

class GetCustomerByIdQuery
{
    public function __construct(private string $id)
    {
    }

    public function getId()
    {
        return $this->id;
    }

}
