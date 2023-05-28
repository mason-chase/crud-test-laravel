<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class CheckPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneUtil->parse($value, 'US');
        try {
            if (! $phoneUtil->isValidNumber($phoneNumber)) {
                $fail('The :attribute must be valid.');
            }
        } catch (\Throwable $th) {
            $fail('An error on :attribute : '.$th->getMessage());
        }
    }
}
