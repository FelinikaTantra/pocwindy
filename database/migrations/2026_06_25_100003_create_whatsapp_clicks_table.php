<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('whatsapp_clicks')) {
            Schema::create('whatsapp_clicks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->string('product_name')->nullable();
                $table->string('referrer_page')->nullable();
                $table->string('session_id', 64)->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_clicks');
    }
};
