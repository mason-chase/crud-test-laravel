<?php

namespace App\Domain\Customer\Models;

use App\Domain\Customer\database\factories\CustomerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

class Customer extends EloquentStoredEvent
{
    use HasUuids, HasFactory;

    const TABLE_NAME = 'customers';
    const COL_UUID = 'uuid';
    const COL_EMAIL = 'email';
    const COL_FIRST_NAME = 'first_name';
    const COL_LAST_NAME = 'last_name';
    const COL_DATE_OF_BIRTH = 'date_of_birth';
    const COL_PHONE_NUMBER = 'phone_number';
    const COL_BACK_ACCOUNT_NUMBER = 'bank_account_number';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::COL_UUID;
    public $guarded = [];
    public $casts = [
        self::COL_UUID => 'string'
    ];

    public function scopeEmail($q, string $email)
    {
        return self::query()->where(self::COL_EMAIL, $email)->first();
    }

    public function scopeUuid($q, string$uuid)
    {
        return self::query()->where(self::COL_UUID, $uuid)->first();
    }

    protected static function newFactory()
    {
        return (new CustomerFactory);
    }

//    public function getRouteKeyName()
//    {
//        return self::COL_UUID;
//    }
}
