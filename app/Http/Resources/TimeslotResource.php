<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeslotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Movie_ID'      => $this->movie->id,
            'Title'         => $this->movie->title,
            'Theatre_name'  => $this->theatre->name,
            'Start_time'    => $this->start_time,
            'End_time'      => $this->end_time,
            'Description'   => $this->movie->description,
            'Theatre_room_no' => $this->room_no,
        ];
    }
}
