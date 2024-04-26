<?php

namespace Tests\Feature\Shop;

use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Enums\FieldStatus;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetViewCategoryIndex(): void
    {
        $this->categoryFactory();
        $this->brandFactory();
        $this->productFactory();
        $title = __('Каталог товаров');
        $perPage = 10;

        $response = $this->get(route('shop.categories.index'));
        $products = Product::with('category')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        $response->assertSuccessful();
        $response->assertViewIs('shops.categories.index');
        $response->assertViewHas([
            'title' => $title,
            'paginator' => $products,
        ]);
    }

    public function testGetViewCategorySingle(): void
    {
        $this->categoryFactory();
        $this->brandFactory();
        $this->productFactory();
        $item = Category::get()->first();
        $title = __('Категория: ' . $item->name);
        $perPage = 10;

        $response = $this->get(route('shop.categories.single', $item));
        $products = Product::with('category')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->where('category_id', '=', $item->id)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        if ($products->isEmpty()) {
            $products = Product::with('category')
                ->where('is_active', '=', FieldStatus::TURN_ON->value)
                ->whereIn('category_id', function ($builder) use ($item) {
                    $builder->select('id')->from('categories')->where('parent_id', '=', $item->id);
            })->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
        }

        $response->assertSuccessful();
        $response->assertViewIs('shops.categories.single');
        $response->assertViewHas([
            'title' => $title,
            'paginator' => $products,
        ]);
    }

    private function categoryFactory(): void
    {
        Category::factory(10)->create();
    }

    private function productFactory(): void
    {
        Product::factory(37)->create();
    }

    private function brandFactory(): void
    {
        Brand::factory(5)->create();
    }

}
