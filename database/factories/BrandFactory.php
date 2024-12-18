<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    public function definition(): array
    {
        static $i = 0;
        $name = fake()->unique()->words(mt_rand(1, 2), true);
        $date = date('Y-m-d H:i:s', strtotime('-1 years +1 month'));
        $createDate = date('Y-m-d H:i:s', strtotime($date . "+{$i} day"));
        $i++;

        return [
            'slug' => Str::slug($name, '-'),
            'name' => $name,
            'description' => fake()->realText(mt_rand(100, 250)),
            'meta_title' => $name,
            'meta_keywords' => fake()->words(mt_rand(2, 5), true),
            'meta_description' => fake()->realText(mt_rand(100, 250)),
            'is_active' => true,
            'created_at' => $createDate,
            'updated_at' => $createDate,
        ];
    }
}