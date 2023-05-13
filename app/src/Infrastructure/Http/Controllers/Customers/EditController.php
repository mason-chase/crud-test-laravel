<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Handler\EditCustomerHandler;
use Ddd\Application\Customers\Queries\EditCustomerQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

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