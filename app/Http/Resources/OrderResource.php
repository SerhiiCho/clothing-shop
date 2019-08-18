<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'total' => $this->total,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'user' => $this->user ?? [],
            'items' => $this->items,
        ];
    }
}
