<?php

namespace App\Validation\Rules;

class Date
{
    public static function default()
    {
        return ['bail', 'required'];
    }
}
