<?php

namespace App\Helpers\Traits;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemsPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

trait ItemHelpers
{
    /**
     * @param \App\Http\Requests\ItemRequest $request
     * @return array|null
     */
    public function uploadPhotos(ItemRequest $request): ?array
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
                $filename = get_file_name($request->title, $ext);
                $path_big = storage_path("app/public/img/big/clothes/{$filename}");
                $path_small = storage_path("app/public/img/small/clothes/{$filename}");

                $this->uploadImages($image, [
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

        return null;
    }

    /**
     * @param array|null $image_names
     * @param \App\Models\Item $item
     * @return void
     */
    public function updateImagesInDb(?array $image_names, Item $item): void
    {
        if (is_null($image_names)) {
            ItemsPhoto::create([
                'item_id' => $item->id,
                'name' => 'default.jpg',
            ]);
        } else {
            $dataSet = array_map(function ($image) use ($item) {
                return [
                    'item_id' => $item->id,
                    'name' => $image,
                ];
            }, $image_names);

            $item->photos()->delete();

            DB::table('items_photos')->insert($dataSet);
        }
    }

    /**
     * This contract creates new item in database if param $item is null,
     * if it's not, than it will update the item that is passed
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item|null $item
     * @return \App\Models\Item
     */
    public function createOrUpdateItem(Request $request, ?Item $item = null): Item
    {
        $items = [
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
            'slug' => $item ? $item->slug : $this->makeSlug($request->title),
            'type_id' => $request->type,
        ];

        if ($item) {
            $item->update($items);
            return $item;
        }

        return user()->items()->create($items);
    }

    /**
     * @param $current_category
     * @return bool
     */
    public function currentStateOfSidebar($current_category): bool
    {
        return $current_category === 'women' || $current_category === 'men';
    }

    public function deleteOldPhotos($photos)
    {
        foreach ($photos as $photo) {
            if ($photo->name != 'default.jpg') {
                Storage::delete("public/img/big/clothes/{$photo->name}");
                Storage::delete("public/img/small/clothes/{$photo->name}");
            }
        }
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     * @param array $image_data
     * @return void
     */
    public function uploadImages(UploadedFile $image, array $image_data): void
    {
        foreach ($image_data as $data) {
            (new ImageManager)
                ->make($image)
                ->fit($data['width'], $data['height'], function ($constraint) {
                    $constraint->upsize();
                }, 'top')
                ->save($data['path']);
        }
    }

    /**
     * Method helper
     *
     * @param string $title
     * @return string
     */
    public function makeSlug(string $title): string
    {
        $slug = str_slug($title);
        $time = time();
        return str_limit("{$slug}_{$time}", 250);
    }
}
