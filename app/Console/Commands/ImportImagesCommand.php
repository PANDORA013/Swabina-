<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageOptimizationService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImportImagesCommand extends Command
{
    protected $signature = 'images:import {--path=public/images : Source path} {--dest=uploads : Destination path}';
    protected $description = 'Import and optimize images from public/images to storage';

    private $imageService;
    private $imported = 0;
    private $failed = 0;
    private $skipped = 0;

    public function __construct(ImageOptimizationService $imageService)
    {
        parent::__construct();
        $this->imageService = $imageService;
    }

    public function handle()
    {
        $sourcePath = $this->option('path');
        $destPath = $this->option('dest');
        
        $this->info("🚀 Starting image import from: {$sourcePath}");
        $this->info("📁 Destination: storage/app/public/{$destPath}");
        $this->newLine();

        // Get all images from source
        $images = File::glob(base_path($sourcePath . '/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE);
        
        if (empty($images)) {
            $this->error("❌ No images found in {$sourcePath}");
            return 1;
        }

        $this->info("📸 Found " . count($images) . " images to import");
        $this->newLine();

        $bar = $this->output->createProgressBar(count($images));
        $bar->start();

        foreach ($images as $imagePath) {
            try {
                $filename = basename($imagePath);
                
                // Create UploadedFile instance
                $file = new UploadedFile(
                    $imagePath,
                    $filename,
                    mime_content_type($imagePath),
                    null,
                    true
                );

                // Optimize and save
                $result = $this->imageService->optimize($file, $destPath);
                
                $this->imported++;
                $bar->advance();
                
            } catch (\Exception $e) {
                $this->failed++;
                $bar->advance();
                $this->newLine();
                $this->error("❌ Failed: {$filename} - " . $e->getMessage());
            }
        }

        $bar->finish();
        $this->newLine(2);

        // Summary
        $this->info("✅ Import Complete!");
        $this->table(
            ['Status', 'Count'],
            [
                ['Imported', $this->imported],
                ['Failed', $this->failed],
                ['Total', count($images)]
            ]
        );

        return 0;
    }
}
