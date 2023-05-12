<?php
namespace Ddd\Infrastructure\Persistence\Eloquent;

use Ddd\Infrastructure\Persistence\Eloquent\Models\CustomerModel;
use Ddd\Domain\Customer\Customer;
use Ddd\Domain\Customer\CustomerRepositoryInterface;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function save(Customer $customer): void
    {
        $model = new CustomerModel([
            'first_name' => $customer->getFirstName(),
            'last_name' => $customer->getLastName(),
            'email' => $customer->getEmail(),
            'bank_account_number' => $customer->getBankAccountNumber(),
            'phone_number' => $customer->getPhoneNumber(),
            'date_of_birth' => $customer->getDateOfBirth(),
        ]);

        $model->save();
    }

    public function getById(int $id): ?Customer
    {
        $model = CustomerModel::find($id);

        if (!$model) {
            return null;
        }

        return new Customer($model->id, $model->first_name,$model->last_name,$model->email,$model->bank_account_number, $model->phone_number, $model->date_of_birth);
    }

    public function getByEmail(string $email): ?Customer
    {
        $model = CustomerModel::where('email', $email)->first();

        if (!$model) {
            return null;
        }

        return new Customer($model->id, $model->first_name,$model->last_name,$model->email,$model->bank_account_number, $model->phone_number, $model->date_of_birth);
    }

    public function delete(Customer $customer): void
    {
        CustomerModel::destroy($customer->getId());
    }

    // Additional implementation of repository methods
    public function update(Customer $customer): void
    {
        $model = new CustomerModel([
            'name' => $customer->getName(),
            'email' => $customer->getEmail(),
        ]);

        $model->update();
    }
}