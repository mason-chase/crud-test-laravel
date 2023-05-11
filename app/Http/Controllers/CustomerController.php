<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
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
        /** @var Customer $exist */
        $exist = Customer::query()->where('first_name', $request->get('first_name'))->where('last_name', $request->get('last_name'))->where('date_of_birth', $request->get('date_of_birth'))->first();

        if (!is_null($exist)) {
            return error_response(null, 'messages.exist_customer', ResponseAlias::HTTP_FOUND);
        }

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
        /** @var Customer $exist */
        $exist = Customer::query()->where('first_name', $request->get('first_name'))->where('last_name', $request->get('last_name'))->where('date_of_birth', $request->get('date_of_birth'))->where('id', '!=', $customer->id)->first();

        if (!is_null($exist)) {
            return error_response(null, 'messages.exist_customer', ResponseAlias::HTTP_FOUND);
        }

        $customer->update($request->all());

        return success_response(new CustomerResource($customer));
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
