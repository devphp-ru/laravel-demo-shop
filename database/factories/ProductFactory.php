<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        static $i = 0;
        $title = fake()->unique()->words(mt_rand(2, 3), true);
        $category = Category::query()->whereNotIn('id', [1, 2, 3])->inRandomOrder()->first();
        $brand = Brand::query()->inRandomOrder()->first();
        $date = date('Y-m-d H:i:s', strtotime('-1 year +1 month'));
        $createDate = date('Y-m-d H:i:s', strtotime($date . "+{$i} day"));

        return [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'slug' => Str::slug($title, '-'),
            'title' => $title,
            'content' => fake()->realText(mt_rand(100, 250)),
            'price' => mt_rand(100, 5000) * 100,
            'quantity' => mt_rand(1, 10),
            'meta_title' => $title,
            'meta_keywords' => fake()->words(mt_rand(1, 5), true),
            'meta_description' => fake()->realText(mt_rand(150, 250), true),
            'thumbnail' => '',
            'is_active' => true,
            'created_at' => $createDate,
            'updated_at' => $createDate,
        ];
    }
}
