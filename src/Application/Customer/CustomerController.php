<?php

namespace Application\Customer;

use Application\Controller;
use Domain\Requests\Customer\StoreCustomerRequest;
use Domain\Customer\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = (new Customer())->all();

        return response(['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $request->validated();

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone_number = $request->phone_number;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->email = $request->email;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->save();

        return response(['message' => 'customer store success'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone_number = $request->phone_number;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->email = $request->email;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->save();

        return response(['message' => 'customer update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response(['message' => 'customer delete success']);
    }
}
