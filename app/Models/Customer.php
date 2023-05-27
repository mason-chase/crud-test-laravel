<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'birth_date', 'phone_number', 'email', 'bank_account_number'];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
