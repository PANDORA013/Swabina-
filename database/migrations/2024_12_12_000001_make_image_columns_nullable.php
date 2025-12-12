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
        // Make image column nullable for Berita
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        // Make image column nullable for Layanan Pages
        if (Schema::hasTable('layanan_pages')) {
            Schema::table('layanan_pages', function (Blueprint $table) {
                $table->string('image')->nullable()->change();
            });
        }

        // Make image column nullable for Sertifikats
        if (Schema::hasTable('sertifikats')) {
            Schema::table('sertifikats', function (Blueprint $table) {
                $table->string('image')->nullable()->change();
            });
        }
        
        // Make image column nullable for Carousels
        if (Schema::hasTable('carousels')) {
            Schema::table('carousels', function (Blueprint $table) {
                $table->string('image')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes (make required again) - be careful if data has nulls
        Schema::table('beritas', function (Blueprint $table) {
            // $table->string('image')->nullable(false)->change();
        });
    }
};
