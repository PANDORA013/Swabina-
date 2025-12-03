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
        Schema::create('contact_page', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Hubungi Kami');
            $table->string('page_subtitle')->nullable();
            $table->text('page_description')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('map_embed_url')->nullable();
            $table->boolean('show_map')->default(true);
            $table->boolean('show_contact_form')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_page');
    }
};
