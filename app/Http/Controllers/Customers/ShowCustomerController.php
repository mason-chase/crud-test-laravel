<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Handler\ShowCustomerHandler;
use App\Domains\Customer\Application\Queries\ShowCustomerQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;

class ShowCustomerController extends Controller
{
    public function __construct(protected ShowCustomerHandler $handler)
    {
    }

    public function __invoke(int $id): CustomerResource
    {
        $query = new ShowCustomerQuery($id);
        return CustomerResource::make($this->handler->handle($query));
    }
}
