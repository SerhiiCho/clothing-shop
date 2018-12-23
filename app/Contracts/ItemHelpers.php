<?php

namespace App\Contracts;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

trait ItemHelpers
{
    /**
     * @param \App\Http\Requests\ItemRequest $request
     * @param int $item_id
     * @return array|null
     */
    public function uploadPhotos(ItemRequest $request, int $item_id): ?array
    {
        if (!$request->has('photos')) {
            return null;
        }

        $i = 0;
        $image_names = [];

        if ($i <= 5) {
            foreach ($request->photos as $image) {
                $i++;
                $ext = $image->getClientOriginalExtension();
                $filename = getFileName($request->title, $ext);
                $path_big = storage_path("app/public/img/big/clothes/{$filename}");
                $path_small = storage_path("app/public/img/small/clothes/{$filename}");

                $this->uploadImages($image, $filename, [
                    [
                        'path' => $path_big,
                        'width' => 360,
                        'height' => 540,
                    ],
                    [
                        'path' => $path_small,
                        'width' => 180,
                        'height' => 270,
                    ],
                ]);
                $image_names[] = $filename;
            }
            return $image_names;
        }
    }

    /**
     * @param array|null $image_names
     * @param int $item_id
     * @return void
     */
    public function updateImagesInDb(?array $image_names, int $item_id): void
    {
        if (is_null($image_names)) {
            ItemsPhoto::create([
                'item_id' => $item_id,
                'name' => 'default.jpg',
            ]);
        } else {
            $dataSet = array_map(function ($image) use ($item_id) {
                return [
                    'item_id' => $item_id,
                    'name' => $image,
                ];
            }, $image_names);

            \DB::table('items_photos')->insert($dataSet);
        }
    }

    /**
     * This contract creates new item in database if param $item is null,
     * if it's not, than it will update the item that is passed
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item|null $item
     */
    public function createOrUpdateItem(Request $request, ?Item $item = null)
    {
        $items = [
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
            'type_id' => $request->type,
        ];

        cache()->forget('categories_men');
        cache()->forget('categories_women');

        return $item
        ? $item->update($items)
        : user()->items()->create($items);
    }

    /**
     * @return bool
     */
    public function currentStateOfSidebar($current_category): bool
    {
        return ($current_category === 'women' || $current_category === 'men')
        ? true
        : false;
    }

    public function deleteOldPhotos($photos)
    {
        foreach ($photos as $photo) {
            if ($photo->name != 'default.jpg') {
                Storage::delete("public/img/big/clothes/{$photo->name}");
                Storage::delete("public/img/small/clothes/{$photo->name}");
            }
            $photo->delete();
        }
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $image_name
     * @param array $image_data
     * @return void
     */
    public function uploadImages(UploadedFile $image, string $image_name, array $image_data): void
    {
        foreach ($image_data as $data) {
            $image_inst = (new ImageManager)
                ->make($image)
                ->fit($data['width'], $data['height'], function ($constraint) {
                    $constraint->upsize();
                }, 'top')
                ->save($data['path']);
        }
    }
}
