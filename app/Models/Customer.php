<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Customer model",
 *     description="Customer model",
 * )
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'phone_number', 'email', 'bank_account_number'];

    /**
     * @OA\Property(
     *     format="int64",
     *     title="ID",
     *     default=1,
     *     description="ID",
     *     readOnly=true,
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     default="2017-02-02 18:31:45",
     *     format="datetime",
     *     description="Create date",
     *     title="Create date",
     *     type="string",
     *     readOnly=true,
     * )
     *
     * @var DateTime
     */
    private DateTime $created_at;

    /**
     * @OA\Property(
     *     default="2017-02-02 18:31:45",
     *     format="datetime",
     *     description="Update date",
     *     title="Update date",
     *     type="string",
     *      readOnly=true,
     * )
     *
     * @var DateTime
     */
    private DateTime $updated_at;

    /**
     * @OA\Property(
     *     default="Hossein",
     *     description="First Name",
     *     title="First Name",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $first_name;

    /**
     * @OA\Property(
     *     default="Khoshniat",
     *     description="Last Name",
     *     title="Last Name",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $last_name;

    /**
     * @OA\Property(
     *     default="2017-02-02 00:00:00",
     *     format="datetime",
     *     description="Date of birth",
     *     title="Date of birth",
     *     type="string"
     * )
     *
     * @var DateTime
     */
    private DateTime $date_of_birth;

    /**
     * @OA\Property(
     *     default="+989134516893",
     *     description="Phone Number",
     *     title="Phone Number",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $phone_number;

    /**
     * @OA\Property(
     *     default="khoshniat.hossein@gmail.com",
     *     description="Email",
     *     title="Email",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $email;

    /**
     * @OA\Property(
     *     default="9878654262",
     *     description="Bank Account Number",
     *     title="Bank Account Number",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $bank_account_number;

    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value)),
            set: fn ($value) => date('Y-m-d', strtotime($value)),
        );
    }
}
