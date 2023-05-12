<?php

namespace App\Utility;

use Illuminate\Http\JsonResponse;

class ApiResponse extends JsonResponse
{
    const SUCCESS = 'success';
    const FAILED = 'failed';
    const HTTP_OK = 200;

    /**
     * @param null $message
     * @param null $data
     * @return JsonResponse
     */
    public static function success($message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status' => self::SUCCESS,
            'statusCode' => self::HTTP_OK,
            'message' => $message,
            'data' => $data,
        ], self::HTTP_OK);
    }

    /**
     * @param $statusCode
     * @param $message
     * @param null $data
     * @return JsonResponse
     */
    public static function failed($statusCode, $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => self::FAILED,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function apiResponse($status, $statusCode, $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
