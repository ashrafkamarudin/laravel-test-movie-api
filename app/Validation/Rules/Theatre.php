<?php

namespace App\Validation\Rules;

class Theatre
{
    public static function name()
    {
        return ['bail', 'required', 'string'];
    }
}
