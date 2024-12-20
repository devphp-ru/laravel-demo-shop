<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property float $price
 * @property int $quantity
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $thumbnail
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Category $category
 * @property-read Brand $brand
 *
 * @mixin Builder
 */
class Product extends BaseModel
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'slug',
        'title',
        'content',
        'price',
        'quantity',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getPriceAttribute($value): float
    {
        return $value / 100;
    }

    public function setPriceAttribute($value): void
    {
        $this->attributes['price'] = $value * 100;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsto(Brand::class);
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class, 'basket_items')->withPivot('quantity');
    }

}
