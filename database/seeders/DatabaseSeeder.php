<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Theatre;
use App\Models\Performer;
use Illuminate\Database\Seeder;
use Database\Seeders\MoviesSeeder;
use Database\Seeders\TimeslotsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Genre::insert([
            ['title' => 'comedy'],
            ['title' => 'action'],
            ['title' => 'adventure']
        ]);

        Theatre::insert([
            ['name' => 'ABC movies']
        ]);

        Performer::insert([
            ['name' => 'Al Pacino'],
            ['name' => 'Gemma Arterton'],
            ['name' => 'Matthew Goode'],
            ['name' => 'Ralph Fiennes']
        ]);

    
        $this->call(MoviesSeeder::class);
        $this->call(TimeslotsSeeder::class);

        Movie::whereTitle('The Irishman')->first()->performers()->attach(Performer::whereName('Al Pacino')->first());
    }
}