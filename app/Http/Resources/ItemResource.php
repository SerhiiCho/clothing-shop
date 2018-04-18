<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
			'id'        => $this->id,
			'title'     => $this->title,
			'price'     => $this->price,
			'sex'       => $this->sex,
			'category'  => $this->category,
			'image'     => $this->image
		];
    }
}
