<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(CreateNewMovie $createNewMovieAction)
    {
        // \App\Models\User::factory(10)->create();

        $movies = collect([
            [
                'title' => 'The Irishman',
                'description' => 'I dont know',
                'genres' => [1]
            ],
            [
                'title' => 'Parasite',
                'description' => 'A poor family, the Kims, con their way into becoming the servants of a rich family, the Parks. But their easy life gets complicated when their deception is threatened with exposure.',
                'genres' => [1]
            ],
            [
                'title' => 'The Favourite',
                'description' => 'In early 18th century England, a frail Queen Anne occupies the throne and her close friend, Lady Sarah, governs the country in her stead. When a new servant, Abigail, arrives, her charm endears her to Sarah.',
                'genres' => [1]
            ],
            [
                'title' => 'The Farewell I', 
                'description' => 'A Chinese family discovers their grandmother has only a short while left to live and decide to keep her in the dark, scheduling a wedding to gather before she dies.',
                'genres' => [1]
            ],
            [
                'title' => 'Marriage Story', 
                'description' => 'Noah Baumbach\'s incisive and compassionate look at a marriage breaking up and a family staying together.',
                'genres' => [1]
            ],
            [
                'title' => 'Booksmart', 
                'description' => 'On the eve of their high school graduation, two academic superstars and best friends realize they should have worked less and played more. Determined not to fall short of their peers, the girls try to cram four years of fun into one night.',
                'genres' => [1]
            ],
        ]);

        Genre::insert([
            ['title' => 'comedy'],
            ['title' => 'action'],
            ['title' => 'adventure']
        ]);

        $movies->each(fn ($parameters) => $createNewMovieAction->create($parameters));
    }
}

class CreateNewMovie {
    public function create(array $array)
    {
        //  validation

        return Movie::create([
            'title' => $array['title'],
            'description' => $array['description']
        ])->genres()->sync([1]);
    }
}