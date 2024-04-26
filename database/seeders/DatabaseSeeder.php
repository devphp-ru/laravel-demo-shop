<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new Filesystem())->cleanDirectory('storage/app/public/uploads/products/18_04_2024');

        Category::factory(10)->create();
        Brand::factory(5)->create();
        Product::factory(37)->create();
    }
}
