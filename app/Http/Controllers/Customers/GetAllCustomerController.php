<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Handler\GetAllCustomerHandler;
use App\Domains\Customer\Application\Queries\GetAllCustomerQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllCustomerController extends Controller
{
    public function __construct(protected GetAllCustomerHandler $handler)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $query = new GetAllCustomerQuery();
        return CustomerResource::collection($this->handler->handle($query));
    }
}
