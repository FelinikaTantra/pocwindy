<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('whatsapp');
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->string('product_name')->nullable(); // snapshot in case product deleted
                $table->string('source')->default('lead_form'); // lead_form, whatsapp_click
                $table->string('status')->default('new');     // new, contacted, negotiation, deal, lost
                $table->string('referrer_page')->nullable();  // page URL they came from
                $table->text('notes')->nullable();            // admin notes
                $table->timestamp('contacted_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
