<?php

namespace App\src\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\src\Application\Customers\Command\UpdateCustomerCommand;
use App\src\Application\Customers\Handler\EditCustomerHandler;
use App\src\Application\Customers\Handler\UpdateCustomerHandler;
use App\src\Application\Customers\Queries\EditCustomerQuery;
use App\src\Application\Customers\Requests\UpdateCustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;

class EditController extends Controller
{
    public function __construct(private EditCustomerHandler $customerHandler)
    {
    }

    public function edit(int $id): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $query = new EditCustomerQuery($id);
        $customer = $this->customerHandler->handle($query);
        return view('customers.edit', compact('customer'));
    }

}