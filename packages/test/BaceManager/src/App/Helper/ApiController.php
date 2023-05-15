<?php

namespace Test\BaceManager\App\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;

/**
 * @OA\Info(title="Application API",version="0.1.0")
 */
class ApiController extends Controller
{
    use DispatchesJobs;

    /**
     *  success Response method
     */
    public function successResponse($data, string $message='') : Response
    {
        return response([
            'error' => false,
            'data' => $data,
            'message' => $message
        ], Response::HTTP_OK, []);
    }
    
    /**
     * error Response method
     */
    public function errorResponse(Array $data=[], int $code=400, string $message='') : Response
    {
        return response([
            'error' => true,
            'data' => $data,
            'message' => $message
        ], $code, []);
    }

    public function paginateObject($item)
    {
        return [
            'total' => $item->total(),
            'count' => $item->count(),
            'per_page' => $item->perPage(),
            'current_page' => $item->currentPage(),
            'total_pages' => $item->lastPage()
        ];
    }
}
