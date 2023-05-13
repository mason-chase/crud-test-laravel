<?php

namespace App\Rules;

use App\Utilities\Text\TextSanitizer;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match(TextSanitizer::$phoneRegex, $value)) {
            $fail('The :attribute is invalid phone number.');
        }
    }
}
