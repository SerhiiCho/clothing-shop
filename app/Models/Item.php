<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Relationship with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with View model
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }

    /**
     * Relationship with ItemsPhoto model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(ItemsPhoto::class);
    }

    /**
     * Relationship with Order model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Relationship with Type model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Eloquent scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Method for search
     *
     * @param string $word
     * @return object
     */
    public static function getByTitleOrTypeName(string $word)
    {
        return self::whereHas('type', function ($query) use ($word) {
            $query->where('name', 'like', "%{$word}%")
                ->orWhere('title', 'like', "%{$word}%");
        })->simplePaginate(20);
    }

    /**
     * Returns only those items that user haven't seen, if there no items
     * the he haven't seen, shows just random
     *
     * @param int $visitor_id
     * @param string|null $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getRandomUnseen(int $visitor_id = null, ?string $category = null)
    {
        $seen = View::whereVisitorId($visitor_id ?? visitor_id())->pluck('item_id');
        $random = self::query();

        if ($category) {
            $random = $random->with('photos')->whereCategory($category);
        }

        $random = $random->inRandomOrder()
            ->where($seen->map(function ($id) {
                return ['id', '!=', $id];
            })->toArray())
            ->inStock()
            ->limit(12)
            ->get();

        // If not enough items to display, show just random items
        if ($random->count() < 6) {
            if ($category) {
                return self::with('photos')
                    ->inRandomOrder()
                    ->whereCategory($category)
                    ->inStock()
                    ->limit(12)
                    ->get();
            }
            return self::inRandomOrder()->inStock()->limit(12)->get();
        }
        return $random;
    }
}
