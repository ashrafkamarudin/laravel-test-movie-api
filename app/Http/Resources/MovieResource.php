<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'Movie_ID'  => $this->id,
            'Title'     => $this->title,
            'Genre'     => implode(' ', $this->genres->map(fn ($genre) => Str::title($genre->title))->toArray()),
            'Description' => $this->description,
        ];
    }
}
