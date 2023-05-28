<?php

namespace App\Http\Controllers;

use App\Events\Customer\DeleteEvent;
use App\Events\Customer\IndexEvent;
use App\Events\Customer\ShowEvent;
use App\Events\Customer\StoreEvent;
use App\Events\Customer\UpdateEvent;
use App\Http\Requests\DeleteCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Swagger\CustomerInterface;
use Illuminate\Http\Response;

class CustomerController extends Controller implements CustomerInterface
{
    public function index()
    {
        $customers = event(new IndexEvent())[0];

        return response()->json($customers, Response::HTTP_OK);
    }

    public function show($id)
    {
        $customers = event(new ShowEvent($id))[0];

        return response()->json($customers, Response::HTTP_OK);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = event(new StoreEvent($request->all()))[0];

        return response()->json($customer, Response::HTTP_CREATED);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = event(new UpdateEvent($id, $request->all()))[0];

        return response()->json($customer, Response::HTTP_OK);
    }

    public function destroy(DeleteCustomerRequest $request, $id)
    {
        event(new DeleteEvent($id));

        return response()->json('Customer Delete Successfully', Response::HTTP_OK);
    }
}
