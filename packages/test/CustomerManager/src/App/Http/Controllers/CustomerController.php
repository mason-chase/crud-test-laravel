<?php

namespace Test\CustomerManager\App\Http\Controllers;

use Test\BaceManager\App\Http\Controllers\ApiController;
use Test\CustomerManager\App\Http\Requests\CustomerDeleteRequest;
use Test\CustomerManager\App\Http\Requests\CustomerIndexRequest;
use Test\CustomerManager\App\Http\Requests\CustomerStoreRequest;
use Test\CustomerManager\App\Http\Requests\CustomerUpdateRequest;
use Test\CustomerManager\App\Http\Resources\CustomerCollection;
use Test\CustomerManager\App\Http\Resources\CustomerResource;
use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;

class CustomerController extends ApiController
{
    public function __construct(
        private CustomerRepository $customerRepo){}

    public function index(CustomerIndexRequest $request)
    {
        $this->successResponse(
            new CustomerCollection(
                $this->customerRepo->get($request->all())
            )
        );
    }

    public function store(CustomerStoreRequest $request)
    {
        $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->create($request->all())
            )
        );
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->update($customer->id, $request->all())
            )
        );
    }

    public function destroy(CustomerDeleteRequest $request)
    {
        $this->customerRepo->multydelete($request->ids);

        $this->successResponse([], '');
    }
}
