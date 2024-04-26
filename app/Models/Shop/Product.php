<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 *
 * @property int $id ID
 * @property int $category_id ID категории
 * @property int $brand_id ID бренда
 * @property string $slug ЧПУ
 * @property string $title Название
 * @property string $content Описание
 * @property int $price Цена
 * @property int $quantity Количество
 * @property string $thumbnail Изображение
 * @property bool $is_active Активность
 * @property \Illuminate\Support\Carbon|null $created_at Дата создания
 * @property \Illuminate\Support\Carbon|null $updated_at Дата обновления
 *
 * @mixin Builder
 * @package App\Models\Shop
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
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

}
