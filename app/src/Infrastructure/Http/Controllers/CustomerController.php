<?php

namespace Ddd\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
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
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->bank_account_number,
                $request->phone_number,
                $request->date_of_birth
            );
              $this->createCustomerHandler->handle($command);

              return Redirect::route('customers.create.show')
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