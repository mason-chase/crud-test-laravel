<?php

namespace Domains\Customer\Http\Controllers\Web;

use App\Utility\ApiResponse;
use Domains\Customer\Http\Requests\UpdateCustomerRequest;
use Domains\Customer\Http\Requests\StoreCustomerRequest;
use Domains\Customer\Models\Customer;
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

    public function index()
    {
        $customers = $this->service->index();

        return view('customers::index', [
            'customers' => $customers,
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $customer = $this->service->show($id);
        return view('customers::show', compact('customer'));
    }

    public function create()
    {
        return view('customers::create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->service->store($request);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully!');
    }

    public function edit($id)
    {
        $customer = $this->service->show($id);
        return view('customers::edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->service->update($request, $id);

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully!');
    }
}
