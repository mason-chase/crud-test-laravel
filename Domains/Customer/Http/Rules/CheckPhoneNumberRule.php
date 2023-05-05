<?php


namespace Domains\Customer\Http\Rules;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Str;

class CheckPhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            // is international
            $isInternational = Str::startsWith($value, '+');
            if($isInternational) {
                $numberProto = $phoneUtil->parse($value, "ZZ");
            }else{
                $numberProto = $phoneUtil->parse($value, "IR");
            }
            if (!$phoneUtil->isValidNumber($numberProto)) {
                $fail('The :attribute must be a valid phone number.');
            }
        } catch (\Throwable $th) {
            $fail('An error occurred while processing :attribute : ' . $th->getMessage());
        }
    }
}
