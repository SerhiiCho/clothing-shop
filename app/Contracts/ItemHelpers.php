<?php

namespace App\Contracts;

use App\Models\ItemsPhoto;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

trait ItemHelpers
{
	/**
	 * @param $request
	 * @param $item_id for creating relationship between item and item_photo
	 */
	public function uploadPhotos($request, $item_id)
	{
		if (request()->hasFile('photos')) {
			$i = 0;
			foreach ($request->photos as $image) {
				$i++;

				if ($i <= 5) {
					$ext = $image->getClientOriginalExtension();
					$filename = getFileName($request->title, $ext);

					(new ImageManager)->make($image)->resize(451, 676)->save(
						storage_path('app/public/img/clothes/' . $filename
					));

					$this->createPhotoInDatabase($item_id, $filename);
				}
			}
		} else {
			$this->createPhotoInDatabase($item_id, 'default.jpg');
		}
	}


	public function createPhotoInDatabase($item_id, $filename)
	{
		return ItemsPhoto::create([
			'item_id' => $item_id,
			'name' => $filename
		]);
	}


	/**
	 * This contract creates new item in database if @param $item is null,
	 * if it's not, than it will update the item that is passed
	 */
	public function createOrUpdateItem($request, $item = null)
	{
		$items = [
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'stock' => $request->stock,
			'price' => $request->price,
			'type_id' => $request->type
		];

		return $item
			? $item->update($items)
			: user()->items()->create($items);
	}


	public function currentStateOfSidebar($current_category)
	{
		return ($current_category === 'women' || $current_category === 'men')
			? true
			: false;
	}


	public function deleteOldPhotos($photos)
	{
		foreach ($photos as $photo) {
			if ($photo->name != 'default.jpg') {
				Storage::delete('public/img/clothes/' . $photo->name);
			}
			$photo->delete();
		}
	}
}