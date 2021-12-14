<?php

namespace App\Actions;

use App\Models\Theatre;

class CreateNewTimeslot {

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

        $theatre->timeslots()->create([
            'movie_id'      => $array['movie']->id,
            'room_no'       => $array['room_no'],
            'start_time'    => $array['start_time'],
            'end_time'      => $array['start_time']->addSeconds($array['movie']->duration)
        ]);
    }
}
