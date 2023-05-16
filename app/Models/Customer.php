<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Customer",
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         example="John"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         example="Doe"
 *     ),
 *     @OA\Property(
 *         property="date_of_birth",
 *         type="string",
 *         format="date",
 *         example="1990-01-01"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         example="johndoe@example.com"
 *     ),
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         example="+1234567890"
 *     ),
 *     @OA\Property(
 *         property="bank_account_number",
 *         type="string",
 *         example="1234567890"
 *     ),
 * )
 */
class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['first_name', 'date_of_birth', 'last_name', 'email', 'phone_number', 'bank_account_number'];
}
