<?php

namespace App\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class PhoneNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneUtil->parse($value, defaultRegion: 'US');
        try {
            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                $fail('The :attribute must be valid.');
            }
        } catch (Exception) {
            $fail('The :attribute must be valid.');
        }
    }
}
