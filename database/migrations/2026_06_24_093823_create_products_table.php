<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('strike_price', 12, 2)->nullable();
            $table->text('description');
            $table->json('colors')->nullable(); // stored as JSON array
            $table->json('sizes')->nullable();  // stored as JSON array
            $table->integer('stock')->default(0);
            $table->string('badge')->nullable(); // Best Seller, New Arrival, Promo
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
