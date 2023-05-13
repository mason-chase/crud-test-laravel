<?php
namespace App\src\Application\Customers\Queries;

class EditCustomerQuery
{
    public function __construct(
        private string $id

    ) {}

    public function getId()
    {
        return $this->id;
    }

}