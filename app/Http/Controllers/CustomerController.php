<?php

namespace App\Http\Controllers;

use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\Handler\CreateCustomerHandler;
use Ddd\Application\Customers\Requests\CreateCustomerRequest;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{

    public function __construct(private CreateCustomerHandler $createCustomerHandler)
    {
    }

    public function store(CreateCustomerRequest $request)
    {
        try {
            $customerData = $request->only([
                'first_name',
                'last_name',
                'email',
                'bank_account_number',
                'phone_number',
                'date_of_birth',
            ]);
            $command = new CreateCustomerCommand(
                $customerData['first_name'],
                $customerData['last_name'],
                $customerData['email'],
                $customerData['bank_account_number'],
                $customerData['phone_number'],
                $customerData['date_of_birth']
            );
            $customer = $this->createCustomerHandler->handle($command);
            return Redirect::route('customers.create.show', $customer->id)
                ->with('success', 'The customer has been created.');
        } catch (\Exception $e) {
            return Redirect::back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function showCreate()
    {
        return view('customers.create');
    }
}