<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date->year,
            'last_view' => $this->last_view,
            'description' => Str::limit($this->description, 250),
            'categories' => $this->categories,
            'countries' => $this->countries,
            'persons' => $this->persons,
            'links' => $this->links,
            'views' => $this->views,
            'path' => $this->path()
        ];
    }
}
