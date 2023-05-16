<?php

namespace App\Domains\Customer\Application\Queries;

class ShowCustomerQuery
{
    public function __construct(public int $id)
    {
    }
}
