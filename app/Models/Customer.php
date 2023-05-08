<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $dateOfBirth
 * @property string $phoneNumber
 * @property string $email
 * @property string bankAccountNumber
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer query()
 * …
 */
class Customer extends Model
{
    use HasFactory;
	protected $fillable = ['firstName','lastName','dateOfBirth','phoneNumber','email','bankAccountNumber'];
}
