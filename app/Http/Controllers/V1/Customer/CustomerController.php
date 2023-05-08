<?php

namespace App\Http\Controllers\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Jobs\Customer\StoreJob;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public  function  store(StoreRequest $request)
	{
		$result = dispatch_sync(new StoreJob($request->validated()));
	}
}
