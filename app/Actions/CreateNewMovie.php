<?php

namespace App\Actions;

use App\Models\Movie;
use App\Validation\Rules\Date;
use App\Validation\Rules\Description;
use App\Validation\Rules\Title;
use Illuminate\Support\Facades\Validator;

class CreateNewMovie {

    private bool $shouldValidate = false;

    public function shouldValidate(): self
    {
        $this->shouldValidate = true;

        return $this;
    }

    public static function validationRules(): array
    {
        return [
            'title'         => Title::default(),
            'description'   => Description::default(),
            'mpaa_rating'   => ['bail'],
            'language'      => ['bail'],
            'duration'      => ['bail', 'required'],
            'releaseDate'   => Date::default(),
        ];
    }

    public function create(array $input): Movie
    {
        if ($this->shouldValidate)
            $input = Validator::make($input, self::validationRules())->validate();

        $movie = Movie::create($input);

        return $movie;
    }
}
