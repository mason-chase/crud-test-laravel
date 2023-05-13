<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class PhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();

            $numberProto = $phoneUtil->parse($value, "IR");

            if (!$phoneUtil->isValidNumber($numberProto)) {
                $fail('The :attribute is invalid phone number.');
            }

        } catch (NumberParseException $e) {
            logger($e);

            $fail('The :attribute is invalid phone number.');
        }
    }
}
