<?php

namespace Src\Customer\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Src\Customer\Domain\Events\CustomerCreatedEvent;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'email',
        'uuid',
        'bank_account_number',
    ];

    public static function createWithAttributes($attributes): static
    {
        $attributes->uuid = (string) Uuid::uuid4();

        event(new CustomerCreatedEvent($attributes));

        return static::uuid($attributes->uuid);
    }
}
