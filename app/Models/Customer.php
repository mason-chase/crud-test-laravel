<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['first_name', 'date_of_birth', 'last_name', 'email', 'phone_number', 'bank_account_number'];
}
