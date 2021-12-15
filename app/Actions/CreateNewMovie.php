<?php

namespace App\Actions;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Performer;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;

class CreateNewMovie {

    public function create(array $input)
    {
        $input = (new MovieAdapter)($input);

        //  validation
        $validated = Validator::make($input, [
            'title' => ['bail', 'required'],
            'description' => ['bail', 'required'],
            'mpaa_rating' => ['bail'],
            'language' => ['bail'],
            'duration' => ['bail', 'required'],
            'releaseDate' => ['bail', 'required'],
            'genres' => ['bail', 'array'],
            'performers' => ['bail', 'array']
        ])->validate();

        $movie = Movie::create(
            collect($validated)->except(['genres', 'performers'])->toArray()
        );

        if (isset($validated['genres']))
            $movie->genres()->sync(
                Genre::whereIn('title', $validated['genres'])
                    ->get(['id'])
                    ->pluck('id')
            );

        if (isset($validated['performers']))
            $movie->performers()->sync(
                Performer::whereIn('name', $validated['performers'])
                    ->get(['id'])
                    ->pluck('id')
            );

        return $movie;
    }
}

/**
 * Not required in real world case. 
 * Required here because input from outside is different than what is accepted 
 *
 * @return void
 */
class MovieAdapter {

    public function __invoke(array $input)
    {
        $input = self::changeArrayKeyIfExist($input, ['genre', 'genres']);
        $input = self::changeArrayKeyIfExist($input, ['performer', 'performers']);
        $input = self::changeArrayKeyIfExist($input, ['release', 'releaseDate']);

        $input['duration'] = isset($input['duration']) 
            ? $input['duration'] 
            : CarbonInterval::make('3 hours')->totalSeconds;

        return $input;
    }

    /**
     * Change Array Key 
     * 
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function changeArrayKeyIfExist($array, $keys)
    {
        // add exception

        [$oldKey, $newKey] = $keys;
        if (isset($array[$oldKey])) {
            // assign old key value to new key
            $array[$newKey] = $array[$oldKey];

            // unset old key
            unset($array[$oldKey]);
        }

        return $array;
    }
}