<?php

namespace Test\CustomerManager\App\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Test\CustomerManager\Models\Customer;

class CheckCustomerFullNameDobIsUnique implements ValidationRule
{
    public function __construct(
        public $first_name,
        public $last_name,
        public $update_mode = false
    ){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            $this->update_mode ||
            Customer::where('first_name', $this->first_name)
                ->where('last_name', $this->last_name)
                ->where('date_of_birth', $value)
                ->exists()
        ) {
            $fail("this customer exists and you can't create a duplicate one");
        }
    }
}
