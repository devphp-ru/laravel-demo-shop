<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Enums\FieldStatus;

/**
 * Class Brand
 *
 * @property int $id ID
 * @property string $slug ЧПУ
 * @property string $name Название
 * @property string $content Описание
 * @property string $thumbnail Изображение
 * @property bool $is_active Активность
 * @property \Illuminate\Support\Carbon|null $created_at Дата создания
 * @property \Illuminate\Support\Carbon|null $updated_at Дата обновления
 *
 * @mixin Builder
 * @package App\Models
 */
class Brand extends BaseModel
{
    protected $fillable = [
        'slug',
        'name',
        'content',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActiveList(): Collection
    {
        return self::where('is_active', '=', FieldStatus::TURN_ON->value)->get();
    }

}
