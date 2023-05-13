<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Customer',
    properties: [
        new OA\Property(property: 'uuid', title: "uuid", description: "UUID", format: "string", default: null, readOnly: true, example: "9f17fa47-e2bf-45fb-8925-b016e6bcb72e"),
        new OA\Property(property: 'email', title: "email", description: "Email for customer", format: "string", default: null, example: "example@gmail.com"),
        new OA\Property(property: 'phone_number', title: "phone_number", description: "Phone number for customer", format: "string", default: null, example: "+989121234567"),
        new OA\Property(property: 'first_name', title: "first_name", description: "First name for customer", format: "string", default: null, example: "Taylor"),
        new OA\Property(property: 'last_name', title: "last_name", description: "Last name for customer", format: "string", default: null, example: "Swift"),
        new OA\Property(property: 'date_of_brith', title: "date_of_brith", description: "Date of brith for customer", format: "string", default: null, example: "1990-01-01"),
        new OA\Property(property: 'bank_account_number', title: "bank_account_number", description: "Bank account number for customer", format: "int", default: null, example: "546363634"),
        new OA\Property(property: 'created_at', title: "bank_account_number", description: "Created at for customer", format: "string", default: null, readOnly: true, example: "2023-05-13T10:15:27.000000Z"),
        new OA\Property(property: 'updated_at', title: "updated_at", description: "Updated at for customer", format: "string", default: null, readOnly: true, example: "2023-05-13T10:15:27.000000Z"),
    ]
)]
#[OA\Schema(
    schema: 'CustomerValidationError',
    properties: [
        new OA\Property(property: 'message', format: "string", example: "The email field is required. (and 5 more errors)"),
        new OA\Property(
            property: 'errors',
            properties: [
                new OA\Property(
                    property: 'email',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The email field is required"),
                    ],
                    format: "array"
                ),
                new OA\Property(
                    property: 'phone_number',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The phone_number field is required"),
                    ],
                    format: "array"
                ),
                new OA\Property(
                    property: 'first_name',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The first_name field is required"),
                    ],
                    format: "array"
                ),
                new OA\Property(
                    property: 'last_name',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The last_name field is required"),
                    ],
                    format: "array"
                ),
                new OA\Property(
                    property: 'date_of_brith',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The date_of_brith field is required"),
                    ],
                    format: "array"
                ),
                new OA\Property(
                    property: 'bank_account_number',
                    properties: [
                        new OA\Property(property: 0, format: "string", example: "The bank_account_number field is required"),
                    ],
                    format: "array"
                ),
            ],
            format: "object"),
    ]
)]
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_brith' => $this->date_of_brith,
            'bank_account_number' => $this->bank_account_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
