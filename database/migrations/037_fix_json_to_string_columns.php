<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix all JSON columns to String/Text to match controller logic
     */
    public function up(): void
    {
        // 1. Perbaiki Tabel Berita
        if (Schema::hasTable('beritas')) {
            Schema::table('beritas', function (Blueprint $table) {
                // Only change if column exists and is json
                if (Schema::hasColumn('beritas', 'title')) {
                    $table->string('title')->nullable()->change();
                }
                if (Schema::hasColumn('beritas', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
            });
        }

        // 2. Perbaiki Tabel FAQ
        if (Schema::hasTable('faqs')) {
            Schema::table('faqs', function (Blueprint $table) {
                if (Schema::hasColumn('faqs', 'question')) {
                    $table->string('question')->nullable()->change();
                }
                if (Schema::hasColumn('faqs', 'answer')) {
                    $table->longText('answer')->nullable()->change();
                }
            });
        }

        // 3. Perbaiki Tabel Sertifikat
        if (Schema::hasTable('sertifikats')) {
            Schema::table('sertifikats', function (Blueprint $table) {
                if (Schema::hasColumn('sertifikats', 'nama_sertifikat')) {
                    $table->string('nama_sertifikat')->nullable()->change();
                }
                if (Schema::hasColumn('sertifikats', 'deskripsi')) {
                    $table->longText('deskripsi')->nullable()->change();
                }
            });
        }

        // 4. Perbaiki Tabel Why Choose Us
        if (Schema::hasTable('why_choose_us')) {
            Schema::table('why_choose_us', function (Blueprint $table) {
                if (Schema::hasColumn('why_choose_us', 'title')) {
                    $table->string('title')->nullable()->change();
                }
                if (Schema::hasColumn('why_choose_us', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
            });
        }
        
        // 5. Perbaiki Tabel Pedoman
        if (Schema::hasTable('pedomans')) {
            Schema::table('pedomans', function (Blueprint $table) {
                if (Schema::hasColumn('pedomans', 'judul')) {
                    $table->string('judul')->nullable()->change();
                }
                if (Schema::hasColumn('pedomans', 'isi')) {
                    $table->longText('isi')->nullable()->change();
                }
            });
        }

        // 6. Perbaiki Tabel Layanan Pages
        if (Schema::hasTable('layanan_pages')) {
            Schema::table('layanan_pages', function (Blueprint $table) {
                if (Schema::hasColumn('layanan_pages', 'title')) {
                    $table->string('title')->nullable()->change();
                }
                if (Schema::hasColumn('layanan_pages', 'content')) {
                    $table->longText('content')->nullable()->change();
                }
            });
        }

        // 7. Perbaiki Tabel Contact Page
        if (Schema::hasTable('contact_pages')) {
            Schema::table('contact_pages', function (Blueprint $table) {
                if (Schema::hasColumn('contact_pages', 'section_name')) {
                    $table->string('section_name')->nullable()->change();
                }
                if (Schema::hasColumn('contact_pages', 'content')) {
                    $table->longText('content')->nullable()->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     * Note: We don't rollback this migration as it would corrupt data
     */
    public function down(): void
    {
        // Empty - do not rollback column type changes
    }
};
