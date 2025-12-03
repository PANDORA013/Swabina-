<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanan_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->text('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Insert default data
        DB::table('layanan_pages')->insert([
            [
                'slug' => 'swa-academy',
                'title' => 'SWA Academy',
                'subtitle' => 'Program Pelatihan dan Pengembangan SDM Profesional',
                'description' => 'SWA Academy adalah divisi pelatihan dan pengembangan SDM dari PT Swabina Gatra yang berkomitmen untuk meningkatkan kompetensi dan profesionalisme sumber daya manusia di berbagai bidang industri. Kami menyediakan program pelatihan yang disesuaikan dengan kebutuhan industri dan standar internasional.',
                'icon' => 'bi-mortarboard',
                'is_active' => true,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'facility-management',
                'title' => 'SWA Facility Management',
                'subtitle' => 'Solusi Manajemen Fasilitas Profesional dan Terpadu',
                'description' => 'SWA Facility Management menyediakan layanan manajemen fasilitas yang komprehensif dan profesional untuk gedung, perkantoran, dan kawasan industri. Kami berkomitmen memberikan solusi terbaik dalam pengelolaan fasilitas dengan standar internasional dan didukung oleh tim yang berpengalaman.',
                'icon' => 'bi-building',
                'is_active' => true,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'digital-solution',
                'title' => 'Digital Solution',
                'subtitle' => 'Solusi Teknologi Digital untuk Transformasi Bisnis',
                'description' => 'SWA Digital Solution menawarkan berbagai layanan teknologi informasi dan solusi digital untuk membantu transformasi bisnis Anda. Dari pengembangan sistem, aplikasi, hingga konsultasi IT, kami siap menjadi partner teknologi terpercaya.',
                'icon' => 'bi-laptop',
                'is_active' => true,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'tour-event',
                'title' => 'SWA Tour & Event Organizer',
                'subtitle' => 'Layanan Penyelenggaraan Event dan Wisata Profesional',
                'description' => 'SWA Tour & Event Organizer adalah layanan profesional untuk penyelenggaraan berbagai acara korporat, wisata perusahaan, dan event khusus. Tim berpengalaman kami siap mewujudkan acara yang berkesan dan berkualitas.',
                'icon' => 'bi-calendar-event',
                'is_active' => true,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'swa-segar',
                'title' => 'SWA Segar',
                'subtitle' => 'Penyediaan Bahan Makanan Segar Berkualitas',
                'description' => 'SWA Segar menyediakan berbagai kebutuhan bahan makanan segar berkualitas tinggi untuk kebutuhan katering, restoran, dan perusahaan. Kami menjamin kesegaran dan kualitas produk dengan sistem distribusi yang terpercaya.',
                'icon' => 'bi-basket',
                'is_active' => true,
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_pages');
    }
};
