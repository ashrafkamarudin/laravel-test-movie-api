<?php

namespace App\Validation\Rules;

class Genre
{
    public static function list(): array
    {
        return ['bail', 'array', 'required'];
    }

    public static function default()
    {
        return ['bail', 'required'];
    }
}
