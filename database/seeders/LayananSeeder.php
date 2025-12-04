<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananPage;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'SWA Academy',
                'slug' => 'swa-academy',
                'subtitle' => 'Pusat Pelatihan & Pengembangan SDM Profesional',
                'description' => 'Pusat pengembangan kompetensi dan pelatihan profesional untuk meningkatkan kualitas SDM Anda. Program training mencakup Leadership & Management, Technical Skills, Soft Skills, dan Professional Certification dengan instruktur bersertifikat.',
                'icon' => 'bi-mortarboard',
                'image' => null,
                'features' => 'Leadership Training, Technical Skills, Soft Skills, Professional Certification, Instruktur Bersertifikat, Sertifikat Resmi',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Facility Management',
                'slug' => 'facility-management',
                'subtitle' => 'Solusi Pengelolaan Fasilitas Gedung Terpadu',
                'description' => 'Layanan pengelolaan fasilitas profesional yang komprehensif untuk gedung dan perkantoran. Mencakup Cleaning Service, Security, Building Maintenance, Landscaping, dan Waste Management dengan tim profesional terlatih dan sistem monitoring 24/7.',
                'icon' => 'bi-building-gear',
                'image' => null,
                'features' => 'Cleaning Service, Security & Access Control, Building Maintenance, Landscaping & Gardening, Waste Management, Monitoring 24/7',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Digital Solution',
                'slug' => 'digital-solution',
                'subtitle' => 'Transformasi Digital untuk Bisnis Modern',
                'description' => 'Solusi teknologi digital inovatif untuk mendukung transformasi digital perusahaan Anda. Layanan mencakup ERP, HRIS, Website & Mobile App Development, IT Infrastructure Setup, dan Digital Transformation Consulting dengan teknologi terkini.',
                'icon' => 'bi-cpu',
                'image' => null,
                'features' => 'ERP System, HRIS, Website Development, Mobile App, IT Infrastructure, Cloud Computing, Digital Transformation',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'SWA Tour Organizer',
                'slug' => 'swa-tour-organizer',
                'subtitle' => 'Travel & Event Organizer Profesional',
                'description' => 'Penyedia jasa perjalanan wisata dan event organizer terpercaya untuk pengalaman tak terlupakan. Layanan mencakup Paket Wisata Domestik & Internasional, Corporate Gathering, MICE, Umroh & Haji, serta Ticketing dengan tour guide profesional.',
                'icon' => 'bi-airplane',
                'image' => null,
                'features' => 'Paket Wisata, Corporate Gathering, Team Building, MICE, Umroh & Haji, Ticketing, Tour Guide Profesional',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Swasegar AMDK',
                'slug' => 'swasegar-amdk',
                'subtitle' => 'Air Minum Berkualitas untuk Kehidupan Sehat',
                'description' => 'Air Minum Dalam Kemasan (AMDK) yang higienis, segar, dan berkualitas tinggi. Tersedia dalam kemasan Cup 240ml, Botol 600ml, dan Gallon 19L. Bersertifikat BPOM, Halal MUI, dan ISO 9001:2015 dengan sumber air dari mata air pegunungan yang terjaga.',
                'icon' => 'bi-cup-straw',
                'image' => null,
                'features' => 'Cup 240ml, Botol 600ml, Gallon 19L, Sertifikat BPOM, Halal MUI, ISO 9001:2015, Sumber Air Pegunungan',
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($data as $item) {
            // Gunakan updateOrCreate agar tidak duplikat jika seeder dijalankan ulang
            LayananPage::updateOrCreate(
                ['slug' => $item['slug']], // Kunci pencarian berdasarkan slug
                $item // Data yang akan di-insert atau update
            );
        }

        $this->command->info('✅ 5 layanan berhasil di-seed ke database!');
    }
}
