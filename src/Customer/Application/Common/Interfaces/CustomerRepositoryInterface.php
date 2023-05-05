<?php

namespace Src\Customer\Application\Common\Interfaces;

interface CustomerRepositoryInterface
{
    public function isCustomerExists(array $fields): bool;
}
