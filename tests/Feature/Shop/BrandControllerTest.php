<?php

namespace Tests\Feature\Shop;

use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Enums\FieldStatus;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetViewBrandIndex(): void
    {
        $this->brandFactory();
        $this->categoryFactory();
        $this->productFactory();
        $title = __('Бренды товаров');
        $perPage = 10;

        $response = $this->get(route('shop.brands.index'));
        $products = Product::with('category', 'brand')
            ->where('is_active', '=', FieldStatus::TURN_ON)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        $response->assertSuccessful();
        $response->assertViewIs('shops.brands.index');
        $response->assertViewHas([
            'title' => $title,
            'paginator' => $products,
        ]);
    }

    public function testGetViewBrandSingle(): void
    {
        $this->brandFactory();
        $this->categoryFactory();
        $this->productFactory();
        $item = Brand::get()->first();
        $title = __('Бренд: ' . $item->name);
        $perPage = 10;

        $response = $this->get(route('shop.brands.single', $item));
        $products = Product::with('category', 'brand')
            ->where('is_active', '=', FieldStatus::TURN_ON)
            ->where('brand_id', '=', $item->id)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        $response->assertSuccessful();
        $response->assertViewIs('shops.brands.single');
        $response->assertviewHas([
            'title' => $title,
            'paginator' => $products,
        ]);
    }

    private function brandFactory(): void
    {
        Brand::factory(5)->create();
    }

    private function categoryFactory(): void
    {
        Category::factory(10)->create();
    }

    private function productFactory(): void
    {
        Product::factory(37)->create();
    }

}
