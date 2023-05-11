<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function view(): JsonResponse
    {
        return success_response(CustomerResource::collection(Customer::all())); //TODO:: Must be get data as pagination
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        return success_response(new CustomerResource($customer));
    }

    /**
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        /** @var Customer $customer */
        $customer = Customer::query()->create($request->all());

        return success_response(new CustomerResource($customer));
    }

    /**
     * @param CustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(CustomerRequest $request, Customer $customer): JsonResponse
    {
        return success_response(new CustomerResource($customer->update($request->all())));
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        return success_response(new CustomerResource($customer->delete()));
    }

}
