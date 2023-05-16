<?php

namespace App\Domains\Customer\Domain\Model;

use App\Domains\Customer\Infrastructure\Persistence\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }
}
