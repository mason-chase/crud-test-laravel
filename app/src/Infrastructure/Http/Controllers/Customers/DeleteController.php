<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Command\DeleteCustomerCommand;
use Ddd\Application\Customers\Handler\DeleteCustomerHandler;

class DeleteController extends Controller
{
    public function __construct(private DeleteCustomerHandler $deleteCustomerHandler)
    {
    }

    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $command = new DeleteCustomerCommand($id);
            $this->deleteCustomerHandler->handle($command);

            return redirect()->route('customers.index')
                ->with('success', __('The customer has been removed.'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}