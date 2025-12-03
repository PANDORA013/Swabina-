<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Consolidate static content pages into single 'pages' table
     * 
     * Menggabungkan tabel-tabel konten statis:
     * - visi_misi_budayas
     * - sekilas_perusahaans
     * - why_choose_us
     * - layanan_pages
     * - contact_page
     * 
     * Menjadi satu tabel 'pages' dengan kolom 'type' untuk membedakan jenis halaman
     */
    public function up(): void
    {
        // Create consolidated pages table
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // visi-misi, sekilas-perusahaan, why-choose-us, etc
            $table->string('title');
            $table->text('content')->nullable();
            $table->enum('type', ['visi_misi', 'sekilas_perusahaan', 'why_choose_us', 'layanan', 'kontak'])->index();
            $table->json('metadata')->nullable(); // Untuk data tambahan (icon, image, order, dll)
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
        });

        // Migrate data from visi_misi_budayas
        if (Schema::hasTable('visi_misi_budayas')) {
            $visiMisiData = DB::table('visi_misi_budayas')->get();
            foreach ($visiMisiData as $item) {
                DB::table('pages')->insert([
                    'slug' => 'visi-misi-' . strtolower($item->type),
                    'title' => ucfirst($item->type),
                    'content' => $item->content,
                    'type' => 'visi_misi',
                    'metadata' => json_encode(['text_align' => $item->text_align ?? 'left']),
                    'is_active' => true,
                    'order' => 0,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }

        // Migrate data from sekilas_perusahaans
        if (Schema::hasTable('sekilas_perusahaans')) {
            $sekilasData = DB::table('sekilas_perusahaans')->get();
            foreach ($sekilasData as $item) {
                DB::table('pages')->insert([
                    'slug' => 'sekilas-perusahaan',
                    'title' => $item->judul ?? 'Sekilas Perusahaan',
                    'content' => $item->deskripsi,
                    'type' => 'sekilas_perusahaan',
                    'metadata' => json_encode([
                        'tahun_berdiri' => $item->tahun_berdiri,
                        'jumlah_karyawan' => $item->jumlah_karyawan,
                        'image' => $item->image,
                    ]),
                    'is_active' => true,
                    'order' => 0,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }

        // Migrate data from why_choose_us
        if (Schema::hasTable('why_choose_us')) {
            $whyChooseData = DB::table('why_choose_us')->get();
            foreach ($whyChooseData as $item) {
                DB::table('pages')->insert([
                    'slug' => 'why-choose-us-' . $item->id,
                    'title' => $item->title,
                    'content' => $item->description,
                    'type' => 'why_choose_us',
                    'metadata' => json_encode([
                        'icon' => $item->icon,
                        'image' => $item->image,
                        'status' => $item->status,
                    ]),
                    'is_active' => $item->status === 'active',
                    'order' => $item->order,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }

        // Migrate data from layanan_pages
        if (Schema::hasTable('layanan_pages')) {
            $layananData = DB::table('layanan_pages')->get();
            foreach ($layananData as $item) {
                DB::table('pages')->insert([
                    'slug' => $item->slug,
                    'title' => $item->title,
                    'content' => $item->description,
                    'type' => 'layanan',
                    'metadata' => json_encode([
                        'subtitle' => $item->subtitle,
                        'icon' => $item->icon,
                        'image' => $item->image,
                        'features' => $item->features,
                    ]),
                    'is_active' => $item->is_active,
                    'order' => $item->order,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }

        // Migrate data from contact_page
        if (Schema::hasTable('contact_page')) {
            $contactData = DB::table('contact_page')->get();
            foreach ($contactData as $item) {
                DB::table('pages')->insert([
                    'slug' => 'kontak',
                    'title' => 'Halaman Kontak',
                    'content' => $item->content ?? '',
                    'type' => 'kontak',
                    'metadata' => json_encode([
                        'email' => $item->email,
                        'phone' => $item->phone,
                        'address' => $item->address,
                    ]),
                    'is_active' => true,
                    'order' => 0,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
