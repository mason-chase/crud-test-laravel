<?php

namespace Test\CustomerManager\App\Http\Controllers;

use Illuminate\Http\Request;
use Test\BaceManager\App\Http\Controllers\ApiController;
use Test\CustomerManager\App\Http\Requests\CustomerDeleteRequest;
use Test\CustomerManager\App\Http\Requests\CustomerIndexRequest;
use Test\CustomerManager\App\Http\Requests\CustomerStoreRequest;
use Test\CustomerManager\App\Http\Resources\CustomerCollection;
use Test\CustomerManager\App\Http\Resources\CustomerResource;
use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;

class CustomerController extends ApiController
{
    private CustomerRepository $customerRepo;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function index(CustomerIndexRequest $request)
    {
        $this->successResponse(
            new CustomerCollection(
                $this->customerRepo->get($request->all())
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->create($request->all())
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->update($customer->id, $request->all())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerDeleteRequest $request)
    {
        $this->customerRepo->multydelete($request->ids);
        
        $this->successResponse([], '');
    }
}
