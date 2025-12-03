<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            // 1. Data Visi, Misi, Budaya
            [
                'key' => 'company_profile',
                'value' => json_encode([
                    'visi' => 'Menjadi perusahaan terdepan dalam Facility Management & Services di Indonesia',
                    'misi' => [
                        'Memberikan layanan facility management berkualitas tinggi dengan standar internasional',
                        'Menciptakan inovasi berkelanjutan dalam pengelolaan fasilitas',
                        'Membangun kemitraan jangka panjang dengan klien melalui kepercayaan dan profesionalisme'
                    ],
                    'budaya' => 'Integritas, Profesionalisme, Inovasi, dan Kepuasan Pelanggan'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 2. Data Link Sosial Media
            [
                'key' => 'social_links',
                'value' => json_encode([
                    'facebook' => 'https://facebook.com/swabinagatra',
                    'instagram' => 'https://instagram.com/swabinagatra',
                    'linkedin' => 'https://linkedin.com/company/pt-swabina-gatra',
                    'youtube' => 'https://youtube.com/@swabinagatra',
                    'whatsapp' => 'https://wa.me/6281234567890',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 3. Data Info Kontak
            [
                'key' => 'company_contact',
                'value' => json_encode([
                    'telepon' => '+62-31-123456',
                    'email' => 'info@swabinagatra.com',
                    'alamat' => 'Jl. Merdeka No. 1, Gresik, Jawa Timur 61121, Indonesia',
                    'jam_operasional' => 'Senin - Jumat: 08:00 - 17:00 WIB'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4. Data "Why Choose Us"
            [
                'key' => 'why_choose_us',
                'value' => json_encode([
                    [
                        'judul' => 'Berpengalaman',
                        'deskripsi' => 'Lebih dari 10 tahun pengalaman dalam industri facility management'
                    ],
                    [
                        'judul' => 'Profesional',
                        'deskripsi' => 'Tim profesional terlatih dan bersertifikat internasional'
                    ],
                    [
                        'judul' => 'Inovatif',
                        'deskripsi' => 'Menggunakan teknologi terkini dalam pengelolaan fasilitas'
                    ],
                    [
                        'judul' => 'Terpercaya',
                        'deskripsi' => 'Dipercaya oleh ratusan klien korporat di Indonesia'
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 5. Data Jejak Langkah (Company Milestones)
            [
                'key' => 'jejak_langkahs',
                'value' => json_encode([
                    [
                        'tahun' => 2010,
                        'deskripsi' => 'Pendirian PT Swabina Gatra dengan fokus pada facility management'
                    ],
                    [
                        'tahun' => 2013,
                        'deskripsi' => 'Ekspansi ke berbagai kota besar di Indonesia'
                    ],
                    [
                        'tahun' => 2016,
                        'deskripsi' => 'Sertifikasi ISO 9001:2015 untuk sistem manajemen mutu'
                    ],
                    [
                        'tahun' => 2019,
                        'deskripsi' => 'Melayani lebih dari 100 klien korporat di seluruh Indonesia'
                    ],
                    [
                        'tahun' => 2023,
                        'deskripsi' => 'Transformasi digital dan peluncuran platform manajemen fasilitas online'
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
