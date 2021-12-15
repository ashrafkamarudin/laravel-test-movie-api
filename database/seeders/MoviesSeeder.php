<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Actions\CreateNewMovie;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CreateNewMovie $createNewMovieAction) 
    {
        $movies = [
            [
                'title' => 'The Irishman',
                'description' => 'An aging hitman recalls his time with the mob and the intersecting events with his friend, Jimmy Hoffa, through the 1950-70s.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2019-09-27"),
            ], [
                'title' => 'Parasite',
                'description' => 'A poor family, the Kims, con their way into becoming the servants of a rich family, the Parks. But their easy life gets complicated when their deception is threatened with exposure.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2019-08-15")
            ], [
                'title' => 'The Favourite',
                'description' => 'In early 18th century England, a frail Queen Anne occupies the throne and her close friend, Lady Sarah, governs the country in her stead. When a new servant, Abigail, arrives, her charm endears her to Sarah.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2018-11-14")
            ], [
                'title' => 'The Farewell I', 
                'description' => 'A Chinese family discovers their grandmother has only a short while left to live and decide to keep her in the dark, scheduling a wedding to gather before she dies.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2019-07-12")
            ], [
                'title' => 'Shoplifters', 
                'description' => 'A family of small-time crooks take in a child they find outside in the cold.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2018-06-08")
            ], [
                'title' => 'Marriage Story', 
                'description' => 'Noah Baumbach\'s incisive and compassionate look at a marriage breaking up and a family staying together.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2020-01-01")
            ], [
                'title' => 'Booksmart', 
                'description' => 'On the eve of their high school graduation, two academic superstars and best friends realize they should have worked less and played more. Determined not to fall short of their peers, the girls try to cram four years of fun into one night.',
                'genres' => ['comedy'],
                'duration' => CarbonInterval::make('3 hours')->totalSeconds,
                'releaseDate' => Carbon::create("2019-03-10")
            ],
        ];

        collect($movies)
            ->each(fn ($parameters) => $createNewMovieAction->create($parameters));
    }
}
