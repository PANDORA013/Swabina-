<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carousels = [
            [
                'title' => 'Facility Management & Services',
                'description' => 'Solusi terpadu untuk manajemen fasilitas modern dengan standar internasional',
                'image' => 'carousel-1.jpg',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Digital Solution Innovation',
                'description' => 'Teknologi terdepan untuk transformasi digital bisnis Anda',
                'image' => 'carousel-2.jpg',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Professional Training & Development',
                'description' => 'Program pelatihan berkualitas untuk pengembangan SDM perusahaan Anda',
                'image' => 'carousel-3.jpg',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Sertifikasi ISO & Standar Internasional',
                'description' => 'Membantu perusahaan mencapai sertifikasi ISO dan standar kualitas global',
                'image' => 'carousel-4.jpg',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($carousels as $carousel) {
            Carousel::create($carousel);
        }
    }
}
