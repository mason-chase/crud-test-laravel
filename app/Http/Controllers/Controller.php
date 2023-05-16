<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ok(JsonResource $resource): JsonResponse
    {
        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    public function created(JsonResource $resource): JsonResponse
    {
        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function accepted(JsonResource $resource): JsonResponse
    {
        return $resource->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
