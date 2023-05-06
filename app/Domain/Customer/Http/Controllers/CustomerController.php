<?php

namespace App\Domain\Customer\Http\Controllers;

use App\Domain\Customer\CustomerAggregateRoot;
use App\Domain\Customer\Http\Requests\CustomerRequest;
use App\Domain\Customer\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Domain\Customer\Http\Resources\CustomerResource;
use App\Domain\Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::query()->get();

        return CustomerResource::collection($customers);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function store(CustomerRequest $request)
    {
        $newUuid = Str::uuid()->toString();

        CustomerAggregateRoot::retrieve($newUuid)
            ->createCustomer($request->all())
            ->persist();

        return new CustomerResource(Customer::Uuid($newUuid));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        CustomerAggregateRoot::retrieve($customer->uuid)
            ->updateCustomer($customer->uuid, $request->all())
            ->persist();

        return new CustomerResource($customer->refresh());
    }

    public function delete(Customer $customer)
    {
        CustomerAggregateRoot::retrieve($customer->uuid)
            ->deleteCustomer($customer->uuid)
            ->persist();

        return [
            'data' => [
                'message' => 'customer deleted.'
            ]
        ];
    }
}
