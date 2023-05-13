<?php

namespace App\Rules;

use App\Models\Customer;
use App\Utilities\Text\TextSanitizer;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomerNameAndBrithDateRule implements ValidationRule
{
    public function __construct(
        protected ?string   $firstName,
        protected ?string   $lastName,
        protected ?Carbon   $dateOfBrith,
        protected ?Customer $customer = null,
    )
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->customer) {
            $findCustomer = Customer::query()
                ->where('id', '!=', $this->customer->getKey())
                ->where('first_name', '=', TextSanitizer::string($this->firstName))
                ->where('last_name', '=', TextSanitizer::string($this->lastName))
                ->where('date_of_brith', '=', $this->dateOfBrith->toDateString())
                ->first();
        } else {
            $findCustomer = Customer::query()
                ->where('first_name', '=', TextSanitizer::string($this->firstName))
                ->where('last_name', '=', TextSanitizer::string($this->lastName))
                ->where('date_of_brith', '=', $this->dateOfBrith->toDateString())
                ->first();
        }

        if ($findCustomer) {
            $fail('The :attribute with first name, last name and date of birth has in exists!');
        }
    }


    protected function isUnique(Customer $customer): bool
    {
        return $this->customer && $this->customer->getKey() === $customer->getKey();
    }
}
