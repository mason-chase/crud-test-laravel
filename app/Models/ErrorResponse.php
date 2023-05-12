<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="ErrorReponse model",
 *     description="Error response model",
 * )
 */
class ErrorResponse extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     default="false",
     *     description="Success",
     *     title="Success",
     *     type="boolean"
     * )
     *
     * @var string
     */
    private string $success;

    /**
     * @OA\Property(
     *     default="Error",
     *     description="Error Message",
     *     title="Message",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $message;

    /**
     * @OA\Property(
     *     description="Data",
     *     title="Data",
     *     type="string",
     *     default="null",
     * )
     *
     * @var string
     */
    private string $data;
}
