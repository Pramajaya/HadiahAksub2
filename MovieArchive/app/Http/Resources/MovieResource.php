<?php

namespace App\Http\Resources;

use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'MovieName' => $this->MovieName,
            'MovieDuration' => $this->MovieDuration,
            'MovieImage' => $this->MovieImage,
            'MovieDirector' => $this->MovieDirector,
            'GenreName' => new GenreResource($this->GenreName)
        ];
    }
}
