<?php
namespace App\src\Application\Customers\Queries;

class GetAllCustomerQuery
{
    public function __construct(
        private string $orderBy = 'first_name',
        private string $orderDirection = 'asc'
    ) {}
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }
}