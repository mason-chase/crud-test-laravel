<?php

namespace Test\CustomerManager\App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Test\CustomerManager\App\Http\Requests\CustomerStoreRequest;
use Test\CustomerManager\App\Http\Requests\CustomerUpdateRequest;
use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;

class CustomerWebController extends Controller
{
    public function __construct(
        private CustomerRepository $customerRepo){}

    public function index(Request $request)
    {
        $customers = $this->customerRepo->get($request->all());
        return view('customers::index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return view('customers::show', compact('customer'));
    }


    public function create()
    {
        return view('customers::create');
    }


    public function store(CustomerStoreRequest $request)
    {
        $this->customerRepo->create($request->validated());
        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer created successfully!');
        
    }


    public function edit(Customer $customer)
    {
        return view('customers::edit', compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->customerRepo->update($customer->id, $request->validated());
        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $this->customerRepo->delete($customer->id);
        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully!');

    }
}
