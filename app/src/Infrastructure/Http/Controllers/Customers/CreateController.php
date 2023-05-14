<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use OpenApi\Annotations as OA;


class CreateController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/customers/create",
     *     summary="Show customer create form",
     *     tags={"Customers"},
     *     @OA\Response(
     *         response="200",
     *         description="Customer create form",
     *     )
     * )
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('customers.create');

    }

}