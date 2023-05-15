<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;
/**
     * @OA\Info(title="Customer Api's",version="1.0.0")
     * @OA\PathItem (
     *     path="/",
     *     summary="Customer",
     * ),
     */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

}
