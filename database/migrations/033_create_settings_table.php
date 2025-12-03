<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Create unified settings table to replace multiple static content tables
     * 
     * Menggabungkan:
     * - company_info
     * - social_links
     * - jejak_langkahs
     * 
     * Struktur:
     * - key: Identifier unik (company_info, social_links, jejak_langkahs, dll)
     * - value: JSON data (fleksibel untuk berbagai struktur)
     * - timestamps: Created/Updated tracking
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary(); // Kunci unik
            $table->longText('value')->nullable(); // JSON data
            $table->timestamps();

            $table->index('key');
        });

        // Migrate data from company_info
        if (Schema::hasTable('company_info')) {
            $companyInfo = DB::table('company_info')->first();
            if ($companyInfo) {
                DB::table('settings')->insert([
                    'key' => 'company_info',
                    'value' => json_encode([
                        'logo' => $companyInfo->logo ?? null,
                        'iso_logos' => $companyInfo->iso_logos ?? null,
                        'created_at' => $companyInfo->created_at,
                        'updated_at' => $companyInfo->updated_at,
                    ]),
                    'created_at' => $companyInfo->created_at,
                    'updated_at' => $companyInfo->updated_at,
                ]);
            }
        }

        // Migrate data from social_links
        if (Schema::hasTable('social_links')) {
            $socialLinks = DB::table('social_links')->first();
            if ($socialLinks) {
                DB::table('settings')->insert([
                    'key' => 'social_links',
                    'value' => json_encode([
                        'facebook' => $socialLinks->facebook,
                        'youtube' => $socialLinks->youtube,
                        'youtube_landing' => $socialLinks->youtube_landing,
                        'linkedin' => $socialLinks->linkedin,
                        'whatsapp' => $socialLinks->whatsapp,
                        'instagram' => $socialLinks->instagram,
                        'created_at' => $socialLinks->created_at,
                        'updated_at' => $socialLinks->updated_at,
                    ]),
                    'created_at' => $socialLinks->created_at,
                    'updated_at' => $socialLinks->updated_at,
                ]);
            }
        }

        // Migrate data from jejak_langkahs
        if (Schema::hasTable('jejak_langkahs')) {
            $jejakLangkahs = DB::table('jejak_langkahs')->get();
            if ($jejakLangkahs->count() > 0) {
                $data = [];
                foreach ($jejakLangkahs as $item) {
                    $data[] = [
                        'id' => $item->id,
                        'tahun' => $item->tahun,
                        'deskripsi' => $item->deskripsi,
                    ];
                }
                
                DB::table('settings')->insert([
                    'key' => 'jejak_langkahs',
                    'value' => json_encode($data),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
