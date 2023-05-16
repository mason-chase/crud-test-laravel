<?php

namespace App\Domains\Customer\Infrastructure\Eloquent;

use App\Domains\Customer\Domain\Entities\CustomerEntity as CustomerEntity;
use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(protected Customer $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->convertListToCustomerEntity(
            $this->model
                ->newQuery()
                ->get()
        );
    }

    public function convertListToCustomerEntity(EloquentCollection $customerCollection): Collection
    {
        $collect = collect();
        foreach ($customerCollection as $customer) {
            $collect->add($this->convertToCustomerEntity($customer));
        }
        return $collect;
    }

    private function convertToCustomerEntity(Customer|Model $customer): CustomerEntity
    {
        return new CustomerEntity(
            id: $customer->id,
            firstName: $customer->first_name,
            dateOfBirth: $customer->date_of_birth,
            lastName: $customer->last_name,
            email: $customer->email,
            phoneNumber: $customer->phone_number,
            bankAccountNumber: $customer->bank_account_number,
        );
    }
}
