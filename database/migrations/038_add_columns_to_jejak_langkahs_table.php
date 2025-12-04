<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Menambahkan kolom year, title, dan description ke tabel jejak_langkahs
     * untuk mendukung fitur timeline di halaman About Us
     */
    public function up()
    {
        Schema::table('jejak_langkahs', function (Blueprint $table) {
            // Cek dan tambahkan kolom year (tahun kejadian)
            if (!Schema::hasColumn('jejak_langkahs', 'year')) {
                $table->string('year', 4)->nullable()->after('id');
            }
            
            // Cek dan tambahkan kolom title (judul milestone)
            if (!Schema::hasColumn('jejak_langkahs', 'title')) {
                $table->string('title')->nullable()->after('year');
            }
            
            // Cek dan tambahkan kolom description (deskripsi milestone)
            if (!Schema::hasColumn('jejak_langkahs', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('jejak_langkahs', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan jika rollback
            if (Schema::hasColumn('jejak_langkahs', 'description')) {
                $table->dropColumn('description');
            }
            
            if (Schema::hasColumn('jejak_langkahs', 'title')) {
                $table->dropColumn('title');
            }
            
            if (Schema::hasColumn('jejak_langkahs', 'year')) {
                $table->dropColumn('year');
            }
        });
    }
};
