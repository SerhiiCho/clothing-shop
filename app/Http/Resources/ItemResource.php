<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
            'photos' => $this->photos,
        ];
    }
}
