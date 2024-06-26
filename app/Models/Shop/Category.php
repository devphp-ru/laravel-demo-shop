<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\FieldStatus;

/**
 * Class Category
 *
 * @property int $id ID
 * @property int $parent_id ID родителя
 * @property string $slug ЧПУ
 * @property string $name Название
 * @property string $content Описание
 * @property string $thumbnail Изображение
 * @property bool $is_active Активность
 * @property \Illuminate\Support\Carbon|null $created_at Дата создания
 * @property \Illuminate\Support\Carbon|null $updated_at Дата обновления
 *
 * @mixin Builder
 * @package App\Models\Shop
 */
class Category extends BaseModel
{
    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'content',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function getActiveList(): Collection
    {
        return self::with('children')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->where('parent_id', '=', FieldStatus::TURN_OFF->value)
            ->get();
    }

}
