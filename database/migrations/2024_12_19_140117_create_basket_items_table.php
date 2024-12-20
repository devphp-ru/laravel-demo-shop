<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basket_items', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->foreignId('basket_id')->comment('ID корзины')->references('id')->on('baskets')->cascadeOnDelete();
            $table->foreignId('product_id')->comment('ID товара')->references('id')->on('products')->cascadeOnDelete();
            $table->bigInteger('quantity')->comment('Количество');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_items');
    }
};
