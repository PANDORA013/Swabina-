<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageCompressionService
{
    /**
     * Compress and save image with specified directory
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory Directory name (e.g., 'sertifikats', 'sekilas_perusahaan')
     * @return string Path to saved image
     * @throws \Exception
     */
    public function compressAndSaveImage($file, $directory = 'uploads')
    {
        try {
            Log::info('Starting image compression', [
                'original_size' => $file->getSize(),
                'directory' => $directory
            ]);
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            // Scale down to max 1200px width while maintaining aspect ratio
            $image->scaleDown(1200);

            // Get and validate file extension
            $extension = strtolower($file->getClientOriginalExtension());
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = in_array($extension, $allowedExtensions) ? $extension : 'jpg';

            // Generate unique filename
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = $directory . '/' . $fileName;

            $fullPath = storage_path('app/public/' . $path);
            
            // Create directory if not exists
            $directoryPath = dirname($fullPath);
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            // Save image based on extension
            switch ($extension) {
                case 'gif':
                    $image->toGif()->save($fullPath);
                    break;
                case 'png':
                    $image->toPng()->save($fullPath);
                    break;
                default:
                    $image->toJpeg(80)->save($fullPath);
            }

            // Verify file was saved
            if (!file_exists($fullPath)) {
                throw new \Exception("Failed to save image to {$fullPath}");
            }

            $compressedSize = filesize($fullPath);
            Log::info('Image compression completed', [
                'compressed_size' => $compressedSize,
                'path' => $path
            ]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Error in ImageCompressionService::compressAndSaveImage', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Delete image from storage
     *
     * @param string $path
     * @return bool
     */
    public function deleteImage($path)
    {
        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                Log::info('Image deleted', ['path' => $path]);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Error deleting image', [
                'path' => $path,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
