<?php

namespace Ddd\Infrastructure\Persistence\Eloquent;

use Ddd\Infrastructure\Persistence\factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['first_name', 'date_of_birth', 'last_name', 'email', 'phone_number', 'bank_account_number'];

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }
}
