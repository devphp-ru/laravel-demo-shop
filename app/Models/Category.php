<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Product $products
 *
 * @mixin Builder
 */
class Category extends BaseModel
{
    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function getListNestedCategories(): Collection
    {
        return self::query()->with(['children'])->where('parent_id', 0)->get();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
