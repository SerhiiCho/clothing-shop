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
			'image'     => $this->image,
			'title'     => $this->title,
			'content'   => $this->content,
			'price1'    => $this->price1,
			'price2'    => $this->price2,
			'sex'       => $this->sex,
			'category'  => $this->category
		];
    }
}
