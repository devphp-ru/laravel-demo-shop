<?php

namespace Tests\Feature\Shop;

use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetViewProductSingle(): void
    {
        Category::factory(10)->create();
        Brand::factory(5)->create();
        $items = Product::factory(5)->create();
        $item = $items->first();

        $response = $this->get(route('shop.product.single', $item));

        $response->assertSuccessful();
        $response->assertViewIs('shops.products.single');
        $response->assertViewHas([
            'item' => $item,
        ]);
    }

}
