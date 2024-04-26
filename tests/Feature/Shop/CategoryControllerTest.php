<?php

namespace Tests\Feature\Shop;

use App\Models\Shop\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetViewCategoryIndex(): void
    {
        $this->categoryFactory();
        $title = __('Каталог товаров');

        $response = $this->get(route('shop.categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('shops.categories.index');
        $response->assertViewHas([
            'title' => $title,
        ]);
    }

    public function testGetViewCategorySingle(): void
    {
        $this->categoryFactory();
        $item = Category::get()->first();
        $title = __('Категория: ' . $item->name);

        $response = $this->get(route('shop.categories.single', $item));

        $response->assertSuccessful();
        $response->assertViewIs('shops.categories.single');
        $response->assertViewHas([
            'title' => $title,
        ]);
    }

    private function categoryFactory(): void
    {
        Category::factory(10)->create();
    }

}
