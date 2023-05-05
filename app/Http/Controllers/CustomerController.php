<?php

namespace App\Http\Controllers;

use App\Helper\ResponseBuilder;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = Customer::all()->toArray();
        return ResponseBuilder
        ::items($items)
        ::statusCode(Response::HTTP_OK)
        ::json();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $item = Customer::create($request->all());
        return ResponseBuilder
        ::items($item->toArray())
        ::message(__('messages.customers.success.stored'))
        ::statusCode(Response::HTTP_CREATED)
        ::json();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        Customer::where('id', $id)->update($request->all());
        $item = Customer::find($id)->first();
        return ResponseBuilder
        ::items($item->toArray())
        ::message(__('messages.customers.success.updated', ['id' => $id]))
        ::statusCode(Response::HTTP_ACCEPTED)
        ::json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
