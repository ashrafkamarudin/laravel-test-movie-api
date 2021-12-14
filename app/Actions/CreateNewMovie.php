<?php

namespace App\Actions;

use App\Models\Movie;

class CreateNewMovie {
    public function create(array $array)
    {
        //  validation

        return Movie::create([
            'title'         => $array['title'],
            'description'   => $array['description'],
            'duration'      => $array['duration']
        ])->genres()->sync([1]);
    }
}
