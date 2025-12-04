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
        Schema::table('sertifikats', function (Blueprint $table) {
            // Rename 'nama' to 'title'
            if (Schema::hasColumn('sertifikats', 'nama')) {
                $table->renameColumn('nama', 'title');
            }
            // Drop 'deskripsi' column (tidak dipakai lagi)
            if (Schema::hasColumn('sertifikats', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            // Kembalikan 'title' ke 'nama'
            if (Schema::hasColumn('sertifikats', 'title')) {
                $table->renameColumn('title', 'nama');
            }
            // Kembalikan kolom 'deskripsi'
            if (!Schema::hasColumn('sertifikats', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
        });
    }
};
