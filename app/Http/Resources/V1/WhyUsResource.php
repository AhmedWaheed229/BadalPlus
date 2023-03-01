<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class WhyUsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'icon' => $this->icon_url,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
