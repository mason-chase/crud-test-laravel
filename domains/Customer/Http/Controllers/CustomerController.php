<?php

namespace Domains\Customer\Http\Controllers;

use Domains\Customer\Http\Requests\DestroyCustomerRequest;
use Domains\Customer\Http\Requests\UpdateCustomerRequest;
use Domains\Customer\Http\Requests\StoreCustomerRequest;
use Domains\Customer\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    protected CustomerService $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return $this->service->index();
    }

    public function show($id): JsonResponse
    {
        return $this->service->show($id);
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        return $this->service->store($request->all());
    }

    public function update(UpdateCustomerRequest $request, $id): JsonResponse
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy(DestroyCustomerRequest $request, $id): JsonResponse
    {
        return $this->service->destroy($id);
    }
}
