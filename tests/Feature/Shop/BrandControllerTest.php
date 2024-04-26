<?php

namespace Tests\Feature\Shop;

use App\Models\Shop\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetViewBrandIndex(): void
    {
        $this->brandFactory();
        $title = __('Бренды товаров');

        $response = $this->get(route('shop.brands.index'));

        $response->assertSuccessful();
        $response->assertViewIs('shops.brands.index');
        $response->assertViewHas([
            'title' => $title,
        ]);
    }

    public function testGetViewBrandSingle(): void
    {
        $this->brandFactory();
        $item = Brand::get()->first();
        $title = __('Бренд: ' . $item->name);

        $response = $this->get(route('shop.brands.single', $item));

        $response->assertSuccessful();
        $response->assertViewIs('shops.brands.single');
        $response->assertviewHas([
            'title' => $title,
        ]);
    }

    private function brandFactory(): void
    {
        Brand::factory(5)->create();
    }
    
}
