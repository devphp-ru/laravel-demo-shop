<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Enums\FieldStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $i = 1;
        $title = fake()->unique()->words(mt_rand(1, 3), true);
        $category = Category::whereNotIn('id', [1, 2, 3])->inRandomOrder()->first();
        $brand = Brand::inRandomOrder()->first();
        $date = \date('Y-m-d H:i:s', \strtotime('-1 years +1 month'));
        $newDate = \date('Y-m-d H:i:s', \strtotime($date . "+{$i} day"));

        return [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'slug' => Str::slug($title),
            'title' => $title,
            'content' => fake()->realText(mt_rand(100, 200)),
            'price' => mt_rand(100, 5000),
            'quantity' => mt_rand(1, 10),
            'thumbnail' => Storage::url(
                'uploads/products/18_04_2024/' . $this->faker->image(storage_path('app/public/uploads/products/18_04_2024/'), 640, 520, null, false)
            ),
            'is_active' => true,
            'created_at' => $newDate,
            'updated_at' => $newDate,
        ];
    }
}
