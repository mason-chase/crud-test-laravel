<?php

namespace App\Utilities\Text;


use Illuminate\Support\Str;

class TextSanitizer
{
    public static string $phoneRegex = '/([+])?([1-9]{1,2})?([0])?(\d{10})/';
    /**
     * The parse email remove "www" and dot in GMail
     *
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     *
     */
    public static function email(string $value): string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            list($username, $host) = explode('@', Str::lower($value));

            $username = str_replace('www.', '', $username);

            $username = match ($host) {
                'gmail.com' => str_replace('.', '', $username),
                default => $username
            };

            return "{$username}@{$host}";
        }

        return '';
    }

    /**
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     */
    public static function normalize(string $value): string
    {
        return (string)Str::of(
            self::string($value)
        )->trim();
    }

    /**
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     */
    public static function string(string $value): string
    {
        return self::number(
            self::encode($value)
        );
    }

    /**
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     */
    public static function number(string $value): string
    {
        $englishChar = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', '_', ','];

        $replaceChar = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '-', 'ـ', ',', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '-', 'ـ', ','];

        return str_replace($replaceChar, $englishChar, $value);
    }

    /**
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     */
    public static function encode(string $value): string
    {
        return (string)\mb_convert_encoding($value, 'UTF-8');
    }

    /**
     * @param string|string[] $value
     * @return string|array
     * @author Arash Farahani <arashmf71@gmail.com>
     */
    public static function sanitize(array|string $value): string|array
    {
        if (is_array($value)) {
            return array_map(
                fn($value) => self::sanitize($value),
                $value
            );
        }

        return self::string($value);
    }

    /**
     * @param string $value
     * @return string
     * @author Arash Farahani <arashmf71@gmail.com>
     *
     */
    public static function phone(string $value): string
    {
        preg_match(static::$phoneRegex, $value, $matches);

        $code = ($matches[2] ?? null) ?: '98';
        $phone = $matches[4] ?? null;

        return $code . $phone;
    }
}
