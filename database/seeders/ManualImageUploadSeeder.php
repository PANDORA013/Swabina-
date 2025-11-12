<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\ImageOptimizationService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ManualImageUploadSeeder extends Seeder
{
    private $imageService;

    public function __construct()
    {
        $this->imageService = new ImageOptimizationService();
    }

    public function run()
    {
        $this->command->info("🚀 Starting manual image upload simulation...\n");

        // 1. Upload Company Info Images
        $this->uploadCompanyInfo();

        // 2. Upload Social Media Links
        $this->uploadSocialIcons();

        $this->command->info("\n✅ All images uploaded successfully through admin simulation!");
    }

    private function uploadCompanyInfo()
    {
        $this->command->info("📋 1. Uploading Company Info Images...");

        // Company Logo
        $logoPath = public_path('assets/logo-perusahaan/LogaSWA_Biru_2cm-removebg-preview.png');
        if (File::exists($logoPath)) {
            $file = new UploadedFile($logoPath, 'logo-swabina.png', 'image/png', null, true);
            $result = $this->imageService->optimize($file, 'company');
            
            DB::table('company_info')->updateOrInsert(
                ['id' => 1],
                [
                    'company_logo' => $result['filename'],
                    'updated_at' => now()
                ]
            );
            
            $this->command->info("   ✅ Logo uploaded: {$result['filename']} (Compression: {$result['compression']}%)");
        }

        // ISO Logos - use existing company images as placeholders
        $isoImages = [
            public_path('assets/logo-perusahaan/LogaSWA_Biru_2cm.png'),
            public_path('assets/gambar_swas/PT Swabina Gatra.jpg'),
            public_path('assets/logo-perusahaan/Fantasi gunung alami.jpg'),
            public_path('assets/logo-perusahaan/Fantasi gunung alami(1).jpg'),
        ];

        foreach ($isoImages as $idx => $isoPath) {
            if (File::exists($isoPath)) {
                $file = new UploadedFile($isoPath, basename($isoPath), mime_content_type($isoPath), null, true);
                $result = $this->imageService->optimize($file, 'iso_logos');
                
                DB::table('company_info')->updateOrInsert(
                    ['id' => 1],
                    [
                        "iso_logo_" . ($idx + 1) => $result['filename'],
                        'updated_at' => now()
                    ]
                );
                
                $this->command->info("   ✅ ISO Logo " . ($idx + 1) . " uploaded: {$result['filename']}");
            }
        }
    }

    private function uploadCarousel()
    {
        $this->command->info("\n🎠 2. Uploading Carousel Images...");

        // Main Carousel - use actual images from public/images
        $carouselFiles = [
            public_path('images/1727449713.jpg'),
            public_path('images/1727447759.jpg'),
            public_path('images/1727357845.jpg'),
        ];

        foreach ($carouselFiles as $idx => $imagePath) {
            if (File::exists($imagePath)) {
                $file = new UploadedFile($imagePath, basename($imagePath), 'image/jpeg', null, true);
                $result = $this->imageService->optimize($file, 'carousel');
                
                DB::table('carousels')->updateOrInsert(
                    ['id' => $idx + 1],
                    [
                        'image' => $result['filename'],
                        'title' => 'Slide ' . ($idx + 1),
                        'updated_at' => now()
                    ]
                );
                
                $this->command->info("   ✅ Carousel " . ($idx + 1) . " uploaded: {$result['filename']}");
            }
        }

        // Carousel Landing (carousellds table)
        $landingFiles = [
            public_path('images/1727357816.jpg'),
            public_path('images/1726977001.jpg'),
            public_path('assets/gambar_swafm/fm1.jpeg'),
        ];

        foreach ($landingFiles as $idx => $imagePath) {
            if (File::exists($imagePath)) {
                $file = new UploadedFile($imagePath, basename($imagePath), mime_content_type($imagePath), null, true);
                $result = $this->imageService->optimize($file, 'carousel_landing');
                
                DB::table('carousellds')->updateOrInsert(
                    ['id' => $idx + 1],
                    [
                        'gambar' => $result['filename'],
                        'updated_at' => now()
                    ]
                );
                
                $this->command->info("   ✅ Landing Carousel " . ($idx + 1) . " uploaded: {$result['filename']}");
            }
        }
    }

    private function uploadBerita()
    {
        $this->command->info("\n📰 3. Uploading Berita (News) Images...");

        // Sample berita images
        $beritaImages = [
            ['id' => 1, 'title' => 'Berita 1', 'image' => 'berita-1.jpg'],
            ['id' => 2, 'title' => 'Berita 2', 'image' => 'berita-2.jpg'],
            ['id' => 3, 'title' => 'Berita 3', 'image' => 'berita-3.jpg'],
        ];

        foreach ($beritaImages as $berita) {
            $imagePath = public_path('images/' . $berita['image']);
            if (File::exists($imagePath)) {
                $file = new UploadedFile($imagePath, $berita['image'], 'image/jpeg', null, true);
                $result = $this->imageService->optimize($file, 'berita');
                
                DB::table('beritas')->updateOrInsert(
                    ['id' => $berita['id']],
                    [
                        'gambar' => $result['filename'],
                        'updated_at' => now()
                    ]
                );
                
                $this->command->info("   ✅ Berita {$berita['id']} uploaded: {$result['filename']}");
            }
        }
    }

    private function uploadLayanan()
    {
        $this->command->info("\n🛠️ 4. Uploading Layanan (Services) Images...");

        // Foto Layanan - use actual service images
        $layananFiles = [
            public_path('assets/gambar_swafm/Cleaning Service.jpg'),
            public_path('assets/gambar_swafm/satpam-baru.jpeg'),
            public_path('assets/gambar_swaac/Team Building.jpg'),
        ];

        foreach ($layananFiles as $idx => $imagePath) {
            if (File::exists($imagePath)) {
                $file = new UploadedFile($imagePath, basename($imagePath), mime_content_type($imagePath), null, true);
                $result = $this->imageService->optimize($file, 'foto_layanans');
                
                DB::table('foto_layanans')->updateOrInsert(
                    ['id' => $idx + 1],
                    [
                        'foto' => $result['filename'],
                        'updated_at' => now()
                    ]
                );
                
                $this->command->info("   ✅ Layanan " . ($idx + 1) . " uploaded: {$result['filename']}");
            }
        }
    }

    private function uploadSocialIcons()
    {
        $this->command->info("\n🌐 5. Uploading Social Media Icons...");

        $socialLinks = [
            'facebook' => 'https://www.facebook.com/PTSwabinaGatra',
            'instagram' => 'https://www.instagram.com/swabinagatra/',
            'youtube' => 'https://www.youtube.com/@PTSwabinaGatra',
            'linkedin' => 'https://www.linkedin.com/company/pt-swabina-gatra/',
            'whatsapp' => 'https://wa.me/6281234567890'
        ];

        DB::table('social_links')->updateOrInsert(
            ['id' => 1],
            array_merge($socialLinks, [
                'created_at' => now(),
                'updated_at' => now()
            ])
        );

        foreach ($socialLinks as $platform => $url) {
            $this->command->info("   ✅ {$platform}: {$url}");
        }
    }
}
