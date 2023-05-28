<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function index()
    {
        $customers = $this->customerRepository->allCustomers();

        return response()->json($customers, Response::HTTP_OK);
    }

    public function show($id)
    {
        $customers = $this->customerRepository->findCustomer($id);

        return response()->json($customers, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $customer = $this->customerRepository->storeCustomer($request->all());

        return response()->json($customer, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $customer = $this->customerRepository->updateCustomer($request->all(), $id);

        return response()->json($customer, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->customerRepository->destroyCustomer($id);

        return response()->json('Customer Delete Successfully', Response::De);
    }
}
