<?php

namespace App\Validation\Rules;

class Str
{
    public static function default()
    {
        return ['bail', 'required', 'string', 'min:5'];
    }
}
