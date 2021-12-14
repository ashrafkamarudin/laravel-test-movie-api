<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Theatre;
use Illuminate\Database\Seeder;
use App\Actions\CreateNewTimeslot;

class TimeslotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CreateNewTimeslot $createNewTimeslot) 
    {
        $timeslots = [
            [
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('The Irishman')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T09:00:00")
            ],[
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('Parasite')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T10:00:00")
            ],
            [
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('The Favourite')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T11:00:00")
            ],
            [
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('The Farewell I')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T12:00:00")
            ],
            [
                'theatre'       => Theatre::first(),
                'movie'         => Movie::whereTitle('Shoplifters')->first(),
                'room_no'       => 1,
                'start_time'    => Carbon::create("2020-04-04T13:00:00")
            ],
        ];

        collect($timeslots)
            ->each(fn ($parameters) => $createNewTimeslot->create($parameters));
    }
}
