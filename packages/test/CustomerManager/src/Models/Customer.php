<?php

namespace Test\CustomerManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Test\CustomerManager\Models\Traits\Relations\CustomerRelationTrait;
use Test\CustomerManager\Models\Traits\Scopes\CustomerScopeTrait;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CustomerRelationTrait;
    use CustomerScopeTrait;
    
}
