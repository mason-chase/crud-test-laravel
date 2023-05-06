<?php

namespace Src\Customer\Application\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BankAccountRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isValid = 1;

        if (!$isValid) {
            $fail('Invalid phone number.');
        }
    }
}
