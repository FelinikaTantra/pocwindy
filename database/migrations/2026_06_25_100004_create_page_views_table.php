<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('page_views')) {
            Schema::create('page_views', function (Blueprint $table) {
                $table->id();
                $table->string('page_url');
                $table->string('session_id', 64)->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->date('viewed_date');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
