<?php

namespace App\Utilities\Text;

use Illuminate\Support\Str;

class TokenGenerator
{
    /**
     * @author  Arash Farahani <arashmf71@gmail.com>
     *
     * @param int $length
     * @param string|null $key
     * @return string
     */
    public static function string(int $length = 16, ?string $key = null): string
    {
        if (is_null($key)) {
            $key = config('app.key');
        }

        $hash = hash_hmac('sha256', Str::random(64), $key);

        return substr($hash, 0, $length);

    }

    /**
     * @author  Arash Farahani <arashmf71@gmail.com>
     *
     * @param int $length
     * @return int
     */
    public static function number(int $length = 8): int
    {
        $min = 1;
        $max = 9;

        while ($length > 1) {
            $min .= 0;
            $max .= 9;

            $length--;
        }

        try {
            $int = mt_rand($min, $max);
        } catch (\Throwable $e) {
            $int = rand($min, $max);
        }

        if (strlen($int) < $length) {
            return static::number($length);
        }

        return $int;
    }

}
