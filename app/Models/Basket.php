<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Product $products
 *
 * @mixin Builder
 */
class Basket extends BaseModel
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'basket_items')->withPivot('quantity');
    }

    public function get(?int $basketId): Basket
    {
        if (is_null($basketId)) {
            $basket = $this->create();
            $basket->touch();

            return $basket;
        }

        return $this->findOrFail($basketId);
    }

    public function addProduct(int $productId, int $quantity): bool
    {
        if ($this->products->contains($productId)) {
            $product = $this->products()->where('product_id', $productId)->first();

            if ($product->quantity < $quantity) {
                return false;
            }

            $pivotRow = $product->pivot;
            $pivotRow->update(['quantity' => $pivotRow->quantity + $quantity]);
        } else {
            $product = Product::findOrFail($productId);

            if ($product->quantity < $quantity) {
                return false;
            }

            $this->products()->attach($productId, ['quantity' => $quantity]);
        }

        $product->update(['quantity' => $product->quantity - $quantity]);

        return true;
    }

    public function increase(int $productId, int $count = 1): void
    {
        $this->change($productId, $count);
    }

    public function decrease(int $productId, int $count = -1): bool
    {
        $this->change($productId, $count);

        return (bool)$this->getProductCount();
    }

    private function change(int $productId, int $count): void
    {
        if ($this->products->contains($productId)) {
            $product = $this->products()->where('product_id', $productId)->first();
            $pivotRow = $product->pivot;
            $newQuantity = $pivotRow->quantity + $count;

            if ($newQuantity > 0) {
                $pivotRow->update(['quantity' => $newQuantity]);
                $this->touch();
                $product->update(['quantity' => $product->quantity + ($count > 0 ? -1 : 1)]);
            } else {
                $pivotRow->delete();
                $product->update(['quantity' => $product->quantity + 1]);
            }
        }
    }

    public function removeProduct(int $productId): bool
    {
        $product = $this->products()->where('product_id', $productId)->first();
        $pivotRow = $product->pivot;
        $product->update(['quantity' => $product->quantity + $pivotRow->quantity]);
        $this->products()->detach($productId);
        $this->touch();

        if (!$this->getProductCount()) {
            $this->delete();

            return true;
        }

        return false;
    }

    public function getProductCount(): int
    {
        return $this->products->count();
    }

    public function getTotalAmount(): float
    {
        $result = 0;
        foreach ($this->products as $product) {
            $result += $product->price * $product->pivot->quantity;
        }

        return $result;
    }

}
