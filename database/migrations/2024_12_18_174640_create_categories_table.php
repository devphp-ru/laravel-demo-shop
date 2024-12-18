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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->bigInteger('parent_id')->unsigned()->default(0)->index()->comment('ID категории');
            $table->string('slug')->unique()->comment('ЧПУ');
            $table->string('name')->comment('Название');
            $table->text('description')->nullable()->comment('Описание');
            $table->string('meta_title')->nullable()->comment('SEO заголовок');
            $table->string('meta_keywords')->nullable()->comment('SEO ключи');
            $table->string('meta_description')->nullable()->comment('SEO описание');
            $table->boolean('is_active')->default(true)->comment('Статус');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
