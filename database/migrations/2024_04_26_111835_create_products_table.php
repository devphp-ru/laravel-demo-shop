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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->bigInteger('category_id')->unsigned()->index()->comment('ID категории');
            $table->bigInteger('brand_id')->unsigned()->index()->comment('ID бренда');
            $table->string('slug')->unique()->index()->comment('ЧПУ');
            $table->string('title')->unique()->comment('Название');
            $table->text('content')->nullable()->comment('Описание');
            $table->integer('price')->unsigned()->comment('Цена');
            $table->integer('quantity')->unsigned()->comment('Количество');
            $table->string('thumbnail')->nullable()->comment('Изображение');
            $table->boolean('is_active')->default(false)->comment('Активность');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
