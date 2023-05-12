<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use libphonenumber\PhoneNumberUtil;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('phoneNumber', function ($attribute, $value, $parameters, $validator) {
            $phoneUtil = PhoneNumberUtil::getInstance();

            try {
                $phoneNumber = $phoneUtil->parse($value, 'ZZ');
                return $phoneUtil->isValidNumber($phoneNumber);
            } catch (\libphonenumber\NumberParseException $e) {
                return false;
            }
        });
    }
}
