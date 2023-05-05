<?php

namespace Src\Customer\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Src\Customer\Domain\Events\CustomerCreatedEvent;
use Src\Customer\Domain\Events\CustomerDeletedEvent;
use Src\Customer\Domain\Events\CustomerUpdatedEvent;

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

    public static function createWithAttributes($attributes)
    {
        $attributes->uuid = (string) Uuid::uuid4();

        event(new CustomerCreatedEvent($attributes));

        return static::uuid($attributes->uuid);
    }

    public static function updateWithAttributes($attributes, $customerResource)
    {
        event(new CustomerUpdatedEvent($attributes, $customerResource->uuid));

        return static::uuid($attributes->uuid);
    }

    public static function deleteCustomer($customer)
    {
        event(new CustomerDeletedEvent($customer));

        return true;
    }

    public static function uuid(string $uuid): ?self
    {
        return static::where('uuid', $uuid)->first();
    }
}
