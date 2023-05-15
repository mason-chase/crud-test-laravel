<?php

namespace Test\CustomerManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Test\CustomerManager\Database\Factories\CustomerFactory;
use Test\CustomerManager\Models\Traits\Relations\CustomerRelationTrait;
use Test\CustomerManager\Models\Traits\Scopes\CustomerScopeTrait;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CustomerRelationTrait;
    use CustomerScopeTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'email',
        'bank_account_number',
    ];


    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
    
}
