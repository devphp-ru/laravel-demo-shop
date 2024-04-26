<?php

namespace Database\Factories\Shop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $i = 0;
        $name = fake()->unique()->words(mt_rand(1, 2), true);

        return [
            'parent_id' => (++$i > 4) ? mt_rand(1, 3) : 0,
            'slug' => Str::slug($name),
            'name' => $name,
            'content' => fake()->realText(mt_rand(150, 200)),
            'thumbnail' => '',
            'is_active' => true,
        ];
    }
}
