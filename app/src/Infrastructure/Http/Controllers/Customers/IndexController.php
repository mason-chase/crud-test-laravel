<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Handler\GetAllCustomerHandler;
use Ddd\Application\Customers\Queries\GetAllCustomerQuery;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(private GetAllCustomerHandler $customerHandler)
    {
    }

    public function index(Request $request)
    {
        $orderBy = $request->query('order_by', 'first_name');
        $orderDirection = $request->query('order_direction', 'asc');

        $query = new GetAllCustomerQuery($orderBy, $orderDirection);
        $customers = $this->customerHandler->handle($query);
        return view('customers.index', compact('customers'));
    }

}