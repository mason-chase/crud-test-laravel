<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Customer Service"
 * )
 *
 * @OA\PathItem(path="/api/v1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
