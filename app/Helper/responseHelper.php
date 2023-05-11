<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

if (!function_exists("success_response")) {

    function success_response($data = null, $message = 'messages.successfully_action', $statusCode = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            "success" => true,
            "message" => __($message),
            "data" => $data
        ], $statusCode);

    }
}

if (!function_exists("create_json_response")) {
    function create_json_response($success, $message, $data, $statusCode): JsonResponse
    {
        return response()->json([
            "success" => $success,
            "message" => __($message),
            "data" => $data
        ], $statusCode);
    }
}

if (!function_exists("error_response")) {
    function error_response($data = null, $message = 'messages.unsuccessfully_action', $statusCode = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => __($message),
            "data" => $data
        ], $statusCode);
    }
}

if (!function_exists("not_found_response")) {
    function not_found_response($message = 'messages.not_found_model'): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => __($message),
            "data" => null
        ], ResponseAlias::HTTP_NOT_FOUND);
    }
}

if (!function_exists("internal_server_error_response")) {
    function internal_server_error_response($message = 'messages.internal_server_error', $data = null): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => __($message),
            "data" => $data
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }
}

if (!function_exists("bad_request_response")) {

    function bad_request_response($message = 'messages.item_not_acceptable'): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => __($message),
            "data" => null
        ], ResponseAlias::HTTP_BAD_REQUEST);

    }
}
