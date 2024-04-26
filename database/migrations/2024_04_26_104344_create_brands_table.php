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
        Schema::create('brands', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('slug')->unique()->index()->comment('ЧПУ');
            $table->string('name')->unique()->comment('Название');
            $table->text('content')->nullable()->comment('Описание');
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
        Schema::dropIfExists('brands');
    }
};
