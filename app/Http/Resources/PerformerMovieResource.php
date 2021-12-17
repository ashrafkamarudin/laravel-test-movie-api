<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerformerMovieResource extends JsonResource
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
            'Overall_rating'  => number_format($this->overall_rating),
            'Title'     => $this->title,
            'Description' => $this->description,
        ];
    }
}
