<?php

namespace App\Validation\Rules;

class Performer
{
    public static function list(): array
    {
        return ['bail', 'array', 'required'];
    }

    public static function name()
    {
        return ['bail', 'required', 'exists:performers,name'];
    }
}
