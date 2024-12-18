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
            $table->foreignId('category_id')->comment('ID категории')->constrained('categories');
            $table->foreignId('brand_id')->comment('ID бренда')->constrained('brands');
            $table->string('slug')->unique()->comment('ЧПУ');
            $table->string('title')->comment('Название');
            $table->text('content')->nullable()->comment('Описание');
            $table->bigInteger('price')->unsigned()->comment('Цена');
            $table->integer('quantity')->unsigned()->comment('Количество');
            $table->string('meta_title')->nullable()->comment('SEO заголовок');
            $table->string('meta_keywords')->nullable()->comment('SEO ключи');
            $table->string('meta_description')->nullable()->comment('SEO описание');
            $table->string('thumbnail')->nullable()->comment('Изображение');
            $table->boolean('is_active')->default(true)->comment('Статус');
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
