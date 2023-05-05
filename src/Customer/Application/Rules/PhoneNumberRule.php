<?php

namespace Src\Customer\Application\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class PhoneNumberRule implements ValidationRule
{
    protected $phoneUtil;
    public function __construct(protected string $region)
    {
        $this->phoneUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneNumber = $this->phoneUtil->parse($value, $this->region);

        $isValid = $this->phoneUtil->isValidNumber($phoneNumber);

        if (!$isValid) {
            $fail('Invalid phone number.');
        }
    }
}
