<?php

namespace Domains\Customer\Repositories\Interfaces;

interface CustomerRepositoryInterface
{
    public function allCustomers();

    public function storeCustomer($data);

    public function findCustomer($id);

    public function updateCustomer($data, $id);

    public function destroyCustomer($id);
}
