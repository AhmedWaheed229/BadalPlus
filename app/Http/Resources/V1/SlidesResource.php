<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'icon' => $this->icon_url,
            'title' => $this->title,
            'list' => SlidesListResource::collection($this->lists),
        ];
    }
}
