<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Menambahkan kolom name, year, dan is_active ke tabel sertifikats
     * untuk mendukung fitur sertifikat di halaman About Us
     */
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            // Tambahkan kolom name (alias untuk nama, agar konsisten dengan controller)
            if (!Schema::hasColumn('sertifikats', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            
            // Tambahkan kolom year (tahun sertifikat diterima)
            if (!Schema::hasColumn('sertifikats', 'year')) {
                $table->string('year', 4)->nullable()->after('deskripsi');
            }
            
            // Tambahkan kolom is_active (status aktif/tidak)
            if (!Schema::hasColumn('sertifikats', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan jika rollback
            if (Schema::hasColumn('sertifikats', 'is_active')) {
                $table->dropColumn('is_active');
            }
            
            if (Schema::hasColumn('sertifikats', 'year')) {
                $table->dropColumn('year');
            }
            
            if (Schema::hasColumn('sertifikats', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
