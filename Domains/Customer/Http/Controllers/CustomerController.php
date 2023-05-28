<?php

namespace Domains\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Domains\Customer\Events\DeleteEvent;
use Domains\Customer\Events\IndexEvent;
use Domains\Customer\Events\ShowEvent;
use Domains\Customer\Events\StoreEvent;
use Domains\Customer\Events\UpdateEvent;
use Domains\Customer\Http\Requests\DeleteCustomerRequest;
use Domains\Customer\Http\Requests\StoreCustomerRequest;
use Domains\Customer\Http\Requests\UpdateCustomerRequest;
use Domains\Customer\Swagger\CustomerInterface;
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
