<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Drop old settings tables that have been migrated to 'settings' table
     * 
     * Tabel-tabel yang dihapus:
     * - company_info (sudah di-migrate ke settings)
     * - social_links (sudah di-migrate ke settings)
     * - jejak_langkahs (sudah di-migrate ke settings)
     */
    public function up(): void
    {
        // NOTE: Commented out table drops to keep tabel untuk backward compatibility
        // dengan controller yang masih mengakses model lama (JejakLangkah, SocialLink, CompanyInfo).
        // Jika ingin drop table, pastikan semua controller sudah migrasi ke settings terlebih dahulu.
        
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // 
        // // Drop old settings tables
        // Schema::dropIfExists('company_info');
        // Schema::dropIfExists('social_links');
        // Schema::dropIfExists('jejak_langkahs');
        // 
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        // Cannot restore dropped tables
        // This is a destructive migration
    }
};
