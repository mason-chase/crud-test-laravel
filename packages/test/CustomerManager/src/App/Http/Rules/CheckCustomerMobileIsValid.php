<?php

namespace Test\CustomerManager\App\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class CheckCustomerMobileIsValid implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        if (!$phoneNumberUtil->isPossibleNumber($value)) {
            $fail('The Phone Number not valid');
        }
    }
}
