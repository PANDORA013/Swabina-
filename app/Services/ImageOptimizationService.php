<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageOptimizationService
{
    private $manager;
    private $maxWidth = 1920;
    private $maxHeight = 1440;
    private $jpegQuality = 75;
    private $webpQuality = 75;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Optimize image and save in multiple formats
     */
    public function optimize($file, $path = 'uploads')
    {
        try {
            Log::info('Starting image optimization', [
                'original_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);

            $image = $this->manager->read($file);

            // Resize if larger than max dimensions
            $image->scale($this->maxWidth, $this->maxHeight);

            // Generate unique filename
            $filename = time() . '_' . uniqid();
            $originalPath = $path . '/' . $filename . '.jpg';
            $webpPath = $path . '/' . $filename . '.webp';

            // Save as JPEG
            $image->toJpeg($this->jpegQuality)->save(
                storage_path('app/public/' . $originalPath)
            );

            // Save as WebP for modern browsers
            $image->toWebp($this->webpQuality)->save(
                storage_path('app/public/' . $webpPath)
            );

            $jpegSize = filesize(storage_path('app/public/' . $originalPath));
            $webpSize = filesize(storage_path('app/public/' . $webpPath));
            $compression = round(((1 - $webpSize / $jpegSize) * 100), 2);

            Log::info('Image optimization completed', [
                'jpeg_size' => $jpegSize,
                'webp_size' => $webpSize,
                'compression_rate' => $compression . '%'
            ]);

            return [
                'jpeg' => $originalPath,
                'webp' => $webpPath,
                'filename' => $filename,
                'compression' => $compression
            ];
        } catch (\Exception $e) {
            Log::error('Image optimization failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete optimized images
     */
    public function delete($filename, $path = 'uploads')
    {
        try {
            Storage::disk('public')->delete($path . '/' . $filename . '.jpg');
            Storage::disk('public')->delete($path . '/' . $filename . '.webp');
            Log::info('Images deleted: ' . $filename);
            return true;
        } catch (\Exception $e) {
            Log::error('Image deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get responsive image HTML with picture element
     */
    public function getResponsiveHtml($filename, $path = 'uploads', $alt = 'Image')
    {
        $jpegUrl = asset('storage/' . $path . '/' . $filename . '.jpg');
        $webpUrl = asset('storage/' . $path . '/' . $filename . '.webp');

        return <<<HTML
<picture>
    <source type="image/webp" srcset="$webpUrl">
    <source type="image/jpeg" srcset="$jpegUrl">
    <img src="$jpegUrl" alt="$alt" loading="lazy" decoding="async">
</picture>
HTML;
    }

    /**
     * Get responsive image HTML with srcset
     */
    public function getResponsiveHtmlWithSrcset($filename, $path = 'uploads', $alt = 'Image')
    {
        $jpegUrl = asset('storage/' . $path . '/' . $filename . '.jpg');
        $webpUrl = asset('storage/' . $path . '/' . $filename . '.webp');

        return <<<HTML
<picture>
    <source 
        type="image/webp" 
        srcset="$webpUrl 1x, $webpUrl 2x"
        sizes="(max-width: 640px) 100vw, 50vw">
    <source 
        type="image/jpeg" 
        srcset="$jpegUrl 1x, $jpegUrl 2x"
        sizes="(max-width: 640px) 100vw, 50vw">
    <img 
        src="$jpegUrl" 
        alt="$alt" 
        loading="lazy" 
        decoding="async"
        style="max-width: 100%; height: auto;">
</picture>
HTML;
    }
}
