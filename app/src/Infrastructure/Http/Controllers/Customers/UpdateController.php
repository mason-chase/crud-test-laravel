<?php

namespace App\src\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\src\Application\Customers\Command\UpdateCustomerCommand;
use App\src\Application\Customers\Handler\UpdateCustomerHandler;
use App\src\Application\Customers\Requests\UpdateCustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;

class UpdateController extends Controller
{
    public function __construct(private UpdateCustomerHandler $updateCustomerHandler)
    {
    }

    public function update(UpdateCustomerRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $command = new UpdateCustomerCommand(
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->bank_account_number,
                $request->phone_number,
                $request->date_of_birth
            );
            $this->updateCustomerHandler->handle($command);

            return Redirect::route('customers.update')
                ->with('success', __('The customer has been updated.'));
        } catch (\Exception $e) {
            return Redirect::back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}