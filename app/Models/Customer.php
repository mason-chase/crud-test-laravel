<?php

namespace App\Models;

use App\Utilities\Text\TextSanitizer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'date_of_brith',
        'phone_number',
        'email',
        'bank_account_number',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uuid' => 'string',
        'first_name' => \App\Casts\StringCast::class,
        'last_name' => \App\Casts\StringCast::class,
        'date_of_brith' => 'datetime:Y-m-d',
        'phone_number' => \App\Casts\PhoneCast::class,
        'email' => \App\Casts\EmailCast::class,
        'bank_account_number' => \App\Casts\NumberCast::class,
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(
            fn(self $model) => $model->fill([
                'uuid' => Str::uuid()
            ])
        );
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param Carbon $dateOfBrith
     * @return Customer|mixed
     */
    public static function findByNameAndBrithDate(string $firstName, string $lastName, Carbon $dateOfBrith): ?Customer
    {
        return Customer::query()->firstWhere([
            'first_name' => TextSanitizer::string($firstName),
            'last_name' => TextSanitizer::string($lastName),
            'date_of_brith' => $dateOfBrith->toDateString(),
        ]);
    }
}
