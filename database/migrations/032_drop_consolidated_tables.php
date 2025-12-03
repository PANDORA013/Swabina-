<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Drop consolidated tables that have been migrated to 'pages' table
     * 
     * Tabel-tabel yang dihapus:
     * - visi_misi_budayas (sudah di-migrate ke pages)
     * - sekilas_perusahaans (sudah di-migrate ke pages)
     * - why_choose_us (sudah di-migrate ke pages)
     * - layanan_pages (sudah di-migrate ke pages)
     * - contact_page (sudah di-migrate ke pages)
     */
    public function up(): void
    {
        // NOTE: Commented out table drops to keep tabel untuk backward compatibility
        // dengan controller yang masih mengakses model lama (WhyChooseUs, SekilasPerusahaan, VisiMisiBudaya, dll).
        // Jika ingin drop table, pastikan semua controller sudah migrasi ke pages/settings terlebih dahulu.
        
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // 
        // // Drop consolidated tables
        // Schema::dropIfExists('visi_misi_budayas');
        // Schema::dropIfExists('sekilas_perusahaans');
        // Schema::dropIfExists('why_choose_us');
        // Schema::dropIfExists('layanan_pages');
        // Schema::dropIfExists('contact_page');
        // 
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        // Cannot restore dropped tables
        // This is a destructive migration
    }
};
