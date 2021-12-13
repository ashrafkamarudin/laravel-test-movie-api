<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Theatre;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(CreateNewMovie $createNewMovieAction, CreateNewShowtime $createNewShowtime)
    {
        // \App\Models\User::factory(10)->create();

        $movies = collect([
            [
                'title' => 'The Irishman',
                'description' => 'An aging hitman recalls his time with the mob and the intersecting events with his friend, Jimmy Hoffa, through the 1950-70s.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
            [
                'title' => 'Parasite',
                'description' => 'A poor family, the Kims, con their way into becoming the servants of a rich family, the Parks. But their easy life gets complicated when their deception is threatened with exposure.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
            [
                'title' => 'The Favourite',
                'description' => 'In early 18th century England, a frail Queen Anne occupies the throne and her close friend, Lady Sarah, governs the country in her stead. When a new servant, Abigail, arrives, her charm endears her to Sarah.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
            [
                'title' => 'The Farewell I', 
                'description' => 'A Chinese family discovers their grandmother has only a short while left to live and decide to keep her in the dark, scheduling a wedding to gather before she dies.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
            [
                'title' => 'Marriage Story', 
                'description' => 'Noah Baumbach\'s incisive and compassionate look at a marriage breaking up and a family staying together.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
            [
                'title' => 'Booksmart', 
                'description' => 'On the eve of their high school graduation, two academic superstars and best friends realize they should have worked less and played more. Determined not to fall short of their peers, the girls try to cram four years of fun into one night.',
                'genres' => [1],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds
            ],
        ]);

        Genre::insert([
            ['title' => 'comedy'],
            ['title' => 'action'],
            ['title' => 'adventure']
        ]);

        $movies->each(fn ($parameters) => $createNewMovieAction->create($parameters));

        Theatre::insert([
            ['name' => 'ABC movies']
        ]);

        $showtimes = collect([
            [
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('The Irishman')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T09:00:00")
            ],
        ]);

        $showtimes->each(fn ($parameters) => $createNewShowtime->create($parameters));
    }
}

class CreateNewMovie {
    public function create(array $array)
    {
        //  validation

        return Movie::create([
            'title' => $array['title'],
            'description' => $array['description'],
            'duration' => $array['duration']
        ])->genres()->sync([1]);
    }
}

class CreateNewShowtime {

    private Theatre $theatre;

    public function for(Theatre $theatre)
    {
        $this->theatre = $theatre;

        return $this;
    }

    public function create(array $array)
    {
        //  validation

        // check if theatre exist

        $theatre = $array['theatre'];

        $theatre->showtimes()->create([
            'movie_id' => $array['movie']->id,
            'room_no' => $array['room_no'],
            'start_time' => $array['start_time'],
            'end_time' => $array['start_time']->addSeconds($array['movie']->duration)
        ]);
    }
}