<?php

namespace Database\Factories\Shop;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(mt_rand(1, 2), true);

        return [
            'slug' => Str::slug($name),
            'name' => $name,
            'content' => fake()->realText(mt_rand(150, 200)),
            'thumbnail' => '',
            'is_active' => true,
        ];
    }
}
