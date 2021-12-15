<?php

namespace App\Validation\Rules;

class Title
{
    public static function default()
    {
        return ['bail', 'required'];
    }
}
