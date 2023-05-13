<?php

namespace App\Utilities\Date;

use Carbon\Carbon;

class DateUtil
{
    /**
     * @author Arash Farahani <arashmf71@gmail.com>
     *
     * @param $date
     * @param string $format
     * @return bool
     */
    public static function validate($date, string $format = 'Y-m-d'): bool
    {
        return Carbon::createFromFormat($format, $date)->isValid();
    }
}
