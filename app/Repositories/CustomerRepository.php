<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function allCustomers()
    {
        return Customer::latest()->paginate(10);
    }

    public function storeCustomer($data)
    {
        return Customer::create($data);
    }

    public function findCustomer($id)
    {
        return Customer::find($id);
    }

    public function updateCustomer($data, $id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->first_name = $data['first_name'];
        $customer->last_name = $data['last_name'];
        $customer->phone_number = $data['phone_number'];
        $customer->email = $data['email'];
        $customer->bank_account_number = $data['bank_account_number'];
        $customer->save();
    }

    public function destroyCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
    }
}
