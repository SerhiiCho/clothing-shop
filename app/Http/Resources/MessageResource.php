<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ip' => $this->ip,
            'phone' => $this->phone,
            'name' => $this->name,
            'total' => $this->total,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'items' => ItemLightResource::collection($this->items),
        ];
    }
}
