<?php

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Competence',
                'description' => 'Tenaga profesional berpengalaman lebih dari 20 tahun di industri. Tim kami terdiri dari expert di bidangnya masing-masing dengan sertifikasi internasional.',
                'icon' => 'bi-brain',
                'image' => null,
                'order' => 1,
                'status' => 'active',
            ],
            [
                'title' => 'Integrity',
                'description' => 'Komitmen penuh dalam memberikan layanan berkualitas tinggi dengan transparansi dan integritas. Kepercayaan klien adalah prioritas utama kami.',
                'icon' => 'bi-heart',
                'image' => null,
                'order' => 2,
                'status' => 'active',
            ],
            [
                'title' => 'Excellence',
                'description' => 'Standar kualitas internasional dengan sertifikasi ISO 9001, ISO 14001, dan ISO 45001. Komitmen untuk continuous improvement dalam setiap aspek.',
                'icon' => 'bi-star-fill',
                'image' => null,
                'order' => 3,
                'status' => 'active',
            ],
            [
                'title' => 'Innovative',
                'description' => 'Teknologi terkini dan solusi inovatif dalam setiap layanan kami. Kami terus berinovasi untuk memberikan value terbaik kepada klien.',
                'icon' => 'bi-lightning-fill',
                'image' => null,
                'order' => 4,
                'status' => 'active',
            ],
            [
                'title' => 'Professional',
                'description' => 'Tim profesional yang siap memberikan solusi terbaik sesuai kebutuhan bisnis Anda. Dedikasi penuh dalam setiap project yang kami tangani.',
                'icon' => 'bi-briefcase',
                'image' => null,
                'order' => 5,
                'status' => 'active',
            ],
        ];

        foreach ($data as $item) {
            WhyChooseUs::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
