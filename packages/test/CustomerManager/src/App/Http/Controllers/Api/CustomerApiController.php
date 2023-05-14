<?php

namespace Test\CustomerManager\App\Http\Controllers\Api;

use Test\BaceManager\App\Helper\ApiController;
use Test\CustomerManager\App\Http\Requests\CustomerDeleteRequest;
use Test\CustomerManager\App\Http\Requests\CustomerIndexRequest;
use Test\CustomerManager\App\Http\Requests\CustomerStoreRequest;
use Test\CustomerManager\App\Http\Requests\CustomerUpdateRequest;
use Test\CustomerManager\App\Http\Resources\CustomerCollection;
use Test\CustomerManager\App\Http\Resources\CustomerResource;
use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;

class CustomerApiController extends ApiController
{
    public function __construct(
        private CustomerRepository $customerRepo){}

    public function index(CustomerIndexRequest $request)
    {
        return $this->successResponse(
            new CustomerCollection(
                $this->customerRepo->get($request->all())
            )
        );
    }

    public function store(CustomerStoreRequest $request)
    {
        return $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->create($request->all())
            )
        );
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        return $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->update($customer->id, $request->all())
            )
        );
    }

    public function destroy(CustomerDeleteRequest $request)
    {
        $this->customerRepo->multydelete($request->ids);

        return $this->successResponse([], '');
    }
}
