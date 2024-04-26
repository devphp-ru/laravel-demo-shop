<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @mixin Builder
 * @package App\Models\Shop
 */
abstract class BaseModel extends Model
{
    use HasFactory;
}
