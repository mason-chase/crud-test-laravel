<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Handler\GetAllCustomerHandler;
use App\Domains\Customer\Application\Queries\GetAllCustomerQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;

class GetAllCustomerController extends Controller
{
    public function __construct(protected GetAllCustomerHandler $handler)
    {
    }

    public function __invoke()
    {
        $query = new GetAllCustomerQuery();
        return $this->ok(CustomerResource::collection($this->handler->handle($query)));
    }
}
