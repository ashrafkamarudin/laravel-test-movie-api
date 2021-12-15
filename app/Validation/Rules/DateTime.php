<?php

namespace App\Validation\Rules;

class DateTime
{
    const DEFAULT_FORMAT = 'Y-m-d H:i:s';

    public static function default()
    {
        return ['bail', 'required', 'date_format:' . self::DEFAULT_FORMAT];
    }

    public static function afterOrEqual(string $date)
    {
        return [...self::default(), 'after_or_equal:' . $date];
    }
}
