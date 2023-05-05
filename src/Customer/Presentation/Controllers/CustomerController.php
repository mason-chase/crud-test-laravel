<?php

namespace Src\Customer\Presentation\Controllers;

use Src\Common\Presentation\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Application\Items\Commands\CreateCustomerCommand;
use Src\Customer\Presentation\Requests\StoreCustomerRequest;
use Src\Customer\Presentation\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function __construct(protected CustomerServiceInterface $customerService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return $this->customerService->save($request->safe()->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        return $this->customerService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
