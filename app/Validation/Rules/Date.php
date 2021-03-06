<?php

namespace App\Validation\Rules;

class Date
{
    public static function default()
    {
        return ['bail', 'required', 'date'];
    }

    public static function afterOrEqual(string $date)
    {
        return [...self::default(), 'after_or_equal:' . $date];
    }
}
