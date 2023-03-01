<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidesListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'content' => $this->content
        ];
    }
}
