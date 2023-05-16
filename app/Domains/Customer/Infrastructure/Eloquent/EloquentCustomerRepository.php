<?php

namespace App\Domains\Customer\Infrastructure\Eloquent;

use App\Domains\Customer\Application\Commands\CreateCustomerCommand;
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

    public function getById(int $id): CustomerEntity
    {
        return $this->convertToCustomerEntity(
            $this->model
                ->newQuery()
                ->findOrFail($id)
        );
    }

    public function create(CreateCustomerCommand $query): CustomerEntity
    {
        return $this->convertToCustomerEntity(
            $this->model
                ->newQuery()
                ->create([
                    'first_name' => $query->getFirstName(),
                    'last_name' => $query->getLastName(),
                    'phone_number' => $query->getPhoneNumber(),
                    'bank_account_number' => $query->getBankAccountNumber(),
                    'email' => $query->getEmail(),
                    'date_of_birth' => $query->getDateOfBirth(),
                ])
        );
    }
}
