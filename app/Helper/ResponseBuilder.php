<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class ResponseBuilder
{
    private static $items = [];

    private static $errors;

    private static $message = '';

    private static $statusCode = 200;

    public static function message(string $message = ''): self
    {
        self::$message = $message;
        return new static;
    }

    public static function errors(MessageBag $errors = null): self
    {
        self::$errors = $errors;
        return new static;
    }

    public static function statusCode(int $statusCode = 200): self
    {
        self::$statusCode = $statusCode;
        return new static;
    }

    public static function items(array $items = []): self
    {
        self::$items = $items;
        return new static;
    }

    public static function json(): JsonResponse
    {
        return response()->json(
            [
                'items' => static::$items,
                'message' => static::$message,
                'errors' => static::$errors,
            ],
            static::$statusCode
        );
    }
}