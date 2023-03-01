<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'logo' => $this->logo,
            'icon' => $this->icon_url,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'content' => $this->content,
        ];
    }
}
