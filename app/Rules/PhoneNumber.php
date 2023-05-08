<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
		$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
		if (! $phoneUtil->isValidNumber($phoneUtil->parse($value,'IR')))
		{
			$fail('invalid phone number');
		}

    }
}
